<?php

namespace App\Http\Controllers;

use App\Enums\UserTypeEnum;
use App\Events\chatPrivateEvent;
use App\Events\CounterChatEvent;
use App\Events\CounterChatGroupEvent;
use App\Events\GroupEvent;
use App\Events\NewChatEvent;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\Message;
use App\Models\MessageReadStatusInGroup;
use App\Models\Template;
use App\Models\User;
use App\Traits\GetClientsForChatTrait;
use App\Traits\GetUserGeneralChatsTrait;
use App\Traits\GetUserGroupTrait;
use App\Traits\GetUsersForChatTrait;
use App\Traits\MessageTrait;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    use GetUsersForChatTrait, MessageTrait, GetUserGroupTrait, GetUserGeneralChatsTrait, GetClientsForChatTrait;

    public function chat_client()
    {
        $client = Auth()->user();
        $users = $this->get_users_for_chat();
        return view('pages.chat.client.chat', compact('client', 'users'));
    }

    public function chat_client_form($receiver_encoded_id)
    {

        $client = Auth()->user();

        $receiver_decoded_id = base64_decode($receiver_encoded_id);
        $receiver = User::find($receiver_decoded_id);

        $users = $this->get_users_for_chat();

        $messages = $this->get_messages($receiver);

        return view('pages.chat.client.formChat', compact(['client', 'receiver', 'messages', 'users']));
    }

    public function chat_company_dashboard()
    {
        $users = $this->get_users_for_chat();

        return view('pages.chat.dashboard.company.chat', compact('users'));
    }

    public function chat_company_form($client_encoded_id)
    {
        $client_decoded_id = base64_decode($client_encoded_id);
        $receiver = User::find($client_decoded_id);

        $users = $this->get_users_for_chat();

        $messages = $this->get_messages($receiver);

        return view('pages.chat.dashboard.company.formChat', compact(['receiver', 'messages', 'users']));
    }

    public function chat_lawyer_dashboard()
    {
        $users = $this->get_users_for_chat();

        return view('pages.chat.dashboard.lawyer.chat', compact('users'));
    }

    public function lawyer_form_dashboard($receiver_encoded_id)
    {
        $receiver_decoded_id = base64_decode($receiver_encoded_id);
        $receiver = User::find($receiver_decoded_id);

        $users = $this->get_users_for_chat();

        $messages = $this->get_messages($receiver);
        $templates = Template::all();

        return view('pages.chat.dashboard.lawyer.formChat', compact(['receiver', 'messages', 'users', 'templates']));
    }

    public function group()
    {
        $groups = $this->get_user_groups();
        return view('pages.chat.dashboard.lawyer.group', compact('groups'));

    }

    public function group_form($group_encoded_id)
    {
        $group_decoded_id = base64_decode($group_encoded_id);
        $group = Group::find($group_decoded_id);
        MessageReadStatusInGroup::where('user_id', Auth()->user()->id)
            ->update(['is_read' => true]);

        $admin_group = User::whereHas('groups', function ($query) use ($group) {
            $query->where('groups.id', $group->id)->where('is_admin', true)->where('user_id', Auth()->user()->id);
        })->first();

        $messages = Message::where('group_id', $group->id)->get();
        $groups = $this->get_user_groups();

        return view('pages.chat.dashboard.lawyer.formGroup', compact(['groups', 'messages', 'group', 'admin_group']));

    }
    public function general_chat()
    {
        $general_chats = $this->get_user_general_chats();
        return view('pages.chat.dashboard.lawyer.generalChat', compact('general_chats'));

    }

    public function general_chat_form($general_chat_encoded_id)
    {
        $general_chat_decoded_id = base64_decode($general_chat_encoded_id);
        $general_chat = Group::find($general_chat_decoded_id);
        MessageReadStatusInGroup::where('user_id', Auth()->user()->id)
            ->update(['is_read' => true]);

        $messages = Message::where('group_id', $general_chat->id)->get();
        $general_chats = $this->get_user_general_chats();

        $admin_general_chat = User::whereHas('general_chats', function ($query) use ($general_chat) {
            $query->where('groups.id', $general_chat->id)->where('is_admin', true)->where('user_id', Auth()->user()->id);

        })->first();
        return view('pages.chat.dashboard.lawyer.formGeneralChat', compact(['general_chats', 'admin_general_chat', 'messages', 'general_chat']));

    }

    public function send_message_to_user(Request $request, $receiver_encoded_id)
    {
        $receiver_decoded_id = base64_decode($receiver_encoded_id);
        $receiver = User::find($receiver_decoded_id);

        if ($request->input('message') == null) {
            return redirect()->back();

        }

        $has_previous_chat = $this->get_messages($receiver);

        $new_message = Message::create([
            'message' => $request->message,
            'sender_id' => auth()->user()->id,
            'receiver_id' => $receiver->id,
        ]);

        if (!is_null(request()->file('attachments'))) {
            $attachments = request()->file('attachments');
            $new_message->addMedia($attachments)
                ->toMediaCollection('attachments');
        }

        $message = $new_message->message;

        $receiver_data = [
            'receiver_encoded_id' => $receiver_encoded_id,
            'receiver_id' => $receiver->id,
            'name' => $receiver->name,
            'profile' => $receiver->getFirstMediaUrl('profile'),
        ];

        $sender_data = [
            'sender_encoded_id' => base64_encode(auth()->user()->id),
            'sender_id' => auth()->user()->id,
            'name' => auth()->user()->name,
            'profile' => Auth()->user()->getFirstMediaUrl('profile'),
        ];
        $attachment = null;
        if ($new_message->getFirstMediaUrl('attachments') != null) {
            $media = $new_message->getMedia('attachments')->first();
            $mime_type = $media->mime_type;
            $extension = explode('/', $mime_type)[1];
            $attachment = [
                'url' => $media->getUrl(),
                'extension' => $extension,
            ];
        }

        $created_at = $new_message->created_at->diffForHumans();
        $message_count = $this->message_count($receiver->id);

        if ($has_previous_chat->isEmpty()) {

            broadcast(new NewChatEvent($message, $receiver_data, $sender_data, $created_at, $message_count));

        }

        broadcast(new CounterChatEvent(1, auth()->user()->id, $receiver->id, $message));

        broadcast(new chatPrivateEvent($receiver, auth()->user()->id, $message, $attachment, $created_at));
        return response()->json([
            'success' => true,
            'message' => $message,
            'created_at' => $created_at,
            'attachment' => $attachment == null ? null : $attachment,
            'sender_id' => auth()->user()->id,
            'receiver_id' => $receiver->id,
            'receiver_encoded_id' => $receiver_encoded_id,
            'receiver_profile' => $receiver->getFirstMediaUrl('profileUser'),
            'receiver_name' => $receiver->name,
            'has_previous_chat' => $has_previous_chat->isEmpty(),
        ]);
    }
    public function send_message_to_group(Request $request, $group_encoded_id)
    {
        $group_decoded_id = base64_decode($group_encoded_id);
        $group = Group::find($group_decoded_id);
        if ($request->input('message') == null) {
            return redirect()->back();

        }
        $new_message = Message::create([
            'message' => $request->message,
            'sender_id' => auth()->user()->id,
            'group_id' => $group->id,
        ]);

        if (!is_null(request()->file('attachments'))) {
            $attachments = request()->file('attachments');
            $new_message->addMedia($attachments)
                ->toMediaCollection('attachments');
        }

        $group_members = GroupUser::where('group_id', $group->id)->where('user_id', '<>', auth()->user()->id)->get();
        foreach ($group_members as $member) {
            MessageReadStatusInGroup::create([
                'message_id' => $new_message->id,
                'user_id' => $member->user_id,
                'is_read' => false,
            ]);
            broadcast(new CounterChatGroupEvent(1, $member->user_id, $group->id));

        }

        $sender_profile = $new_message->sender->getFirstMediaUrl('profile');
        $sender_name = $new_message->sender->name;
        $sender_id_encoded = base64_encode($new_message->sender->id);
        $sender_id = $new_message->sender->id;

        $message = $new_message->message;
        $created_at = $new_message->created_at->diffForHumans();
        $attachment = null;
        if ($new_message->getFirstMediaUrl('attachments') != null) {
            $media = $new_message->getMedia('attachments')->first();
            $mime_type = $media->mime_type;
            $extension = explode('/', $mime_type)[1];
            $attachment = [
                'url' => $media->getUrl(),
                'extension' => $extension,
            ];
        }
        broadcast(new GroupEvent($sender_profile, $sender_id_encoded, $sender_id, $sender_name, $message, $attachment, $created_at, $group->id));

        return response()->json([
            'success' => true,
            'message' => $message,
            'created_at' => $created_at,
            'attachment' => $attachment == null ? null : $attachment,
            'sender_id' => $sender_id,
        ]);
    }

    public function contact()
    {
        $users = User::where('is_active', true)->where('type', UserTypeEnum::lawyer)->get();

        return view('pages.chat.dashboard.lawyer.contact', compact('users'));
    }
    public function contact_client()
    {
        $users = $this->get_clients_for_chat();

        return view('pages.chat.dashboard.lawyer.ContactClient', compact('users'));
    }
    public function form_contact_client($receiver_encoded_id)
    {
        $receiver_decoded_id = base64_decode($receiver_encoded_id);
        $receiver = User::find($receiver_decoded_id);

        $users = $this->get_clients_for_chat();

        $messages = $this->get_messages($receiver);

        return view('pages.chat.dashboard.lawyer.formContactClient', compact(['receiver', 'messages', 'users']));
    }
    public function attachments($encodedIdReceiver)
    {
        $decodedId = base64_decode($encodedIdReceiver);
        $receiver = User::find($decodedId);

        $messages = Message::where('sender_id', auth()->user()->id)
            ->where('receiver_id', $receiver->id)
            ->orWhere(function ($query) use ($receiver) {
                $query->where('sender_id', $receiver->id)
                    ->where('receiver_id', auth()->user()->id);
            })->whereHas('media', function ($query) {
            $query->where('collection_name', 'attachments');
        })
            ->paginate(config('constants.PAGINATION_COUNT'));

        return view('pages.chat.attachments', compact('messages'));
    }
    public function attachments_group($encodedIdGroup)
    {
        $decodedId = base64_decode($encodedIdGroup);
        $group = Group::find($decodedId);

        $messages = Message::where('group_id', $group->id)->whereHas('media', function ($query) {
            $query->where('collection_name', 'attachments');
        })
            ->paginate(config('constants.PAGINATION_COUNT'));

        return view('pages.group.attachments', compact('messages'));
    }

}

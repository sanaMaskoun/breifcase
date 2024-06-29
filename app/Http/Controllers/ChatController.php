<?php

namespace App\Http\Controllers;

use App\Events\chatPrivateEvent;
use App\Events\CounterChatEvent;
use App\Events\CounterChatGroupEvent;
use App\Events\GroupEvent;
use App\Events\NewChatEvent;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\Message;
use App\Models\MessageReadStatusInGroup;
use App\Models\User;
use App\Traits\GetUsersForChatTrait;
use App\Traits\MessageTrait;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    use GetUsersForChatTrait, MessageTrait;
   

    public function chat()
    {
        $client = Auth()->user();
        $users = $this->get_users_for_chat();
        return view('pages.chat.chat', compact('client', 'users'));
    }
    public function chat_form($receiver_encoded_id)
    {
        $client = Auth()->user();

        $receiver_decoded_id = base64_decode($receiver_encoded_id);
        $receiver = User::find($receiver_decoded_id);

        $users = $this->get_users_for_chat();

        $messages = $this->get_messages($receiver);

        return view('pages.chat.formChat', compact(['client', 'receiver','messages', 'users']));
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
    ///////////



    public function getUserGroups()
    {
        $groups = User::find(Auth()->user()->id)->groups;
        $groups->each(function ($group) {
            $message_count = $this->messageCountInGroup($group->id);

            $group->message_count = $message_count;

        });

        return $groups;

    }
    public function getUserGeneralChats()
    {
        $general_chats = User::find(Auth()->user()->id)->generalChats;
        $general_chats->each(function ($general_chat) {
            $message_count = $this->messageCountInGroup($general_chat->id);

            $general_chat->message_count = $message_count;

        });

        return $general_chats;

    }

    public function messageCountInGroup($group_id)
    {
        return MessageReadStatusInGroup::where('user_id', Auth()->user()->id)
            ->whereHas('message', function ($query) use ($group_id) {
                $query->where('group_id', $group_id);
            })
            ->where('is_read', false)
            ->count();
    }

    public function getLawyers()
    {
        return User::where('is_active', true)
            ->where('id', '<>', Auth()->user()->id)
            ->whereHas('roles', function ($query) {
                $query->whereIn('name', ['lawyer', 'legalConsultant', 'typingCenter']);
            })
            ->get();
    }

    public function getFilteredLawyersByName($name)
    {
        return User::where('is_active', true)
            ->where('id', '<>', Auth()->user()->id)
            ->whereHas('roles', function ($query) {
                $query->whereIn('name', ['lawyer', 'legalConsultant', 'typingCenter']);
            })
            ->where('name', 'like', '%' . $name . '%')
            ->get();
    }

    public function group_form($encodedId)
    {
        $decodedId = base64_decode($encodedId);
        $group = Group::find($decodedId);

        MessageReadStatusInGroup::where('user_id', Auth()->user()->id)
            ->update(['is_read' => true]);

        $admin_group = User::whereHas('groups', function ($query) use ($group) {
            $query->where('groups.id', $group->id)->where('is_admin', true)->where('user_id', Auth()->user()->id);
        })->first();

        $admin_general_chat = User::whereHas('generalChats', function ($query) use ($group) {
            $query->where('groups.id', $group->id)->where('is_admin', true)->where('user_id', Auth()->user()->id);

        })->first();

        $users = session('users');
        $groups = session('groups');
        $lawyers = session('lawyers');
        $general_chats = session('general_chats');
        $messages = Message::where('group_id', $group->id)->get();

        return view('pages.chat.formGroup', compact(['lawyers', 'groups', 'general_chats', 'users', 'messages', 'admin_group', 'admin_general_chat', 'group']));

    }

    public function send_message_to_group(Request $request, $encodedId)
    {
        $decodedId = base64_decode($encodedId);
        $group = Group::find($decodedId);

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

            foreach ($attachments as $attachment) {
                $new_message->addMedia($attachment)
                    ->withCustomProperties(['do_not_replace' => true])
                    ->toMediaCollection('attachments');
            }
        }

        $groupMembers = GroupUser::where('group_id', $group->id)->where('user_id', '<>', auth()->user()->id)->get();
        foreach ($groupMembers as $member) {
            MessageReadStatusInGroup::create([
                'message_id' => $new_message->id,
                'user_id' => $member->user_id,
                'is_read' => false,
            ]);
            broadcast(new CounterChatGroupEvent(1, $member->user_id, $group->id));

        }

        $sender_profile = $new_message->sender->getFirstMediaUrl('profileUser');
        $sender_name = $new_message->sender->name;
        $sender_id_encoded = base64_encode($new_message->sender->id);
        $sender_id = $new_message->sender->id;

        $message = $new_message->message;
        $created_at = $new_message->created_at->diffForHumans();
        $attachment = is_null(request()->file('attachments')) ? null : $new_message->getFirstMediaUrl('attachments');

        broadcast(new GroupEvent($sender_profile, $sender_id_encoded, $sender_id, $sender_name, $message, $attachment, $created_at, $group->id));

        return response()->json([
            'success' => true,
            'message' => $message,
            'created_at' => $created_at,
            'attachment' => $attachment,
            'sender_id' => $sender_id,
        ]);
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

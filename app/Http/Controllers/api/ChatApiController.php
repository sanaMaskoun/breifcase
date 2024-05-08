<?php

namespace App\Http\Controllers\api;

use App\Events\chatPrivateEvent;
use App\Events\GroupEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChatResource;
use App\Http\Resources\GroupMessagesResource;
use App\Http\Resources\UserResource;
use App\Models\Group;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatApiController extends Controller
{
    public function get_message_in_chat(User $receiver)
    {
        $messages = Message::where('sender_id', auth()->user()->id)
            ->where('receiver_id', $receiver->id)
            ->orWhere(function ($query) use ($receiver) {
                $query->where('sender_id', $receiver->id)
                    ->where('receiver_id', auth()->user()->id);
            })
            ->get();

        return ChatResource::collection($messages->load('receiver', 'sender'));
    }

    public function get_message_in_group(Group $group)
    {

        $admin = User::whereHas('groups', function ($query) use ($group) {
            $query->where('groups.id', $group->id)->where('is_admin', true);
        })->first();

        $messages = Message::where('group_id', $group->id)->get();

        return ['admin' => new UserResource($admin),
            'messages' => GroupMessagesResource::collection($messages->load('sender'))];

    }

    public function send_message_to_user(Request $request, User $receiver)
    {
        if ($request->message != null) {
            $new_message = Message::create([
                'message' => $request->message,
                'sender_id' => auth()->user()->id,
                'receiver_id' => $receiver->id,
            ]);
        } else {
            $new_message = Message::create([
                'message' => $request->attachment->getClientOriginalName(),
                'sender_id' => auth()->user()->id,
                'receiver_id' => $receiver->id,
            ]);
            $new_message->addMedia($request->file('attachment'))
                ->toMediaCollection('attachments');
        }

        $message = $new_message->message;
        $sender_id = auth()->user()->id;
        $created_at = $new_message->created_at->diffForHumans();
        $attachment = $request->attachments ? null : $new_message->getFirstMediaUrl('attachments');

        broadcast(new chatPrivateEvent($receiver, $sender_id, $message, $attachment, $created_at));

        return new ChatResource($new_message->load('receiver', 'sender'));

    }

    public function send_message_to_group(Request $request, Group $group)
    {

        if ($request->message != null) {
            $new_message = Message::create([
                'message' => $request->message,
                'sender_id' => auth()->user()->id,
                'group_id' => $group->id,
            ]);
        } else {
            $new_message = Message::create([
                'message' => $request->attachment->getClientOriginalName(),
                'sender_id' => auth()->user()->id,
                'group_id' => $group->id,
            ]);
            $new_message->addMedia($request->file('attachment'))
                ->toMediaCollection('attachments');
        }

        $sender_profile = $new_message->sender->getFirstMediaUrl('profileUser');
        $sender_name = $new_message->sender->name;
        $sender_id_encoded = base64_encode($new_message->sender->id);
        $sender_id = $new_message->sender->id;

        $message = $new_message->message;
        $created_at = $new_message->created_at->diffForHumans();
        $attachment = $request->attachments ? null : $new_message->getFirstMediaUrl('attachments');

        broadcast(new GroupEvent($sender_profile, $sender_id_encoded, $sender_id, $sender_name, $message, $attachment, $created_at, $group->id));

        return new GroupMessagesResource($new_message->load('sender'));

    }

    public function attachments_chat(User $receiver)
    {
        $messages = Message::whereHas('media', function ($query) {
            $query->where('collection_name', 'attachments');
        })->where('sender_id', auth()->user()->id)
            ->where('receiver_id', $receiver->id)
            ->orWhere(function ($query) use ($receiver) {
                $query->where('sender_id', $receiver->id)
                    ->where('receiver_id', auth()->user()->id)->whereHas('media', function ($query) {
                    $query->where('collection_name', 'attachments');
                });
            })->get();
        return ChatResource::collection($messages->load('receiver', 'sender'));

    }
    public function attachments_group(Group $group)
    {

        $messages = Message::where('group_id', $group->id)->whereHas('media', function ($query) {
            $query->where('collection_name', 'attachments');
        })->get();

        return GroupMessagesResource::collection($messages->load('sender'));

    }
}

<?php
namespace App\Traits;

use App\Models\Message;
use App\Models\User;
use App\Traits\MessageCountInGroupTrait;

trait GetUserGeneralChatsTrait
{
    use MessageCountInGroupTrait;

    public function get_user_general_chats()
    {

        $general_chats = User::find(Auth()->user()->id)->general_chats;
        $general_chats->each(function ($general_chat) {
            $latest_message = Message::where('group_id', $general_chat->id)
            ->latest()
            ->first();

            $message_count = $this->message_count_in_group($general_chat->id);

            $general_chat->message_count = $message_count;
            $general_chat->latest_message = $latest_message;


        });

        return $general_chats;

    }
}

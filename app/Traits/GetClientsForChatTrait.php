<?php
namespace App\Traits;

use App\Enums\UserTypeEnum;
use App\Models\Message;
use App\Models\User;
use App\Traits\MessageCountTrait;

trait GetClientsForChatTrait
{

    use MessageCountTrait;
    public function get_clients_for_chat()
    {
        $users = User::where('type' , UserTypeEnum::client)->whereHas('sender_message', function ($query) {
                $query->where('receiver_id', Auth()->user()->id);
            })
            ->orWhereHas('receiver_message', function ($query) {
                $query->where('sender_id', Auth()->user()->id);
            })
            ->where('type' , UserTypeEnum::client)
            ->get();
        $users->each(function ($user) {
            $latest_message = Message::where('sender_id', auth()->user()->id)
                ->where('receiver_id', $user->id)
                ->orWhere(function ($query) use ($user) {
                    $query->where('sender_id', $user->id)
                        ->where('receiver_id', auth()->user()->id);
                })
                ->latest()
                ->first();

            $message_count = $this->message_count($user->id);

            $user->latest_message = $latest_message;
            $user->message_count = $message_count;

        });
        return $users;
    }
}

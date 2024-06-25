<?php
namespace App\Traits;

use App\Models\Message;

trait MessageTrait
{

    public function get_messages($user)
    {
        $messages = Message::where('sender_id', auth()->user()->id)
            ->where('receiver_id', $user->id)
            ->orWhere(function ($query) use ($user) {
                $query->where('sender_id', $user->id)
                    ->where('receiver_id', auth()->user()->id);
            })
            ->get();

        $messages->each(function ($message) use ($user) {
            $message->where('receiver_id', auth()->user()->id)
                ->where('sender_id', $user->id)
                ->update(['is_read' => true]);
        });

        return $messages;
    }
}

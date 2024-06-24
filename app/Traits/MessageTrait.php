<?php
namespace App\Traits;

use App\Models\Message;

trait MessageTrait
{

    public function get_messages($sender)
    {
        $messages = Message::where('sender_id', auth()->user()->id)
            ->where('receiver_id', $sender->id)
            ->orWhere(function ($query) use ($sender) {
                $query->where('sender_id', $sender->id)
                    ->where('receiver_id', auth()->user()->id);
            })
            ->get();

        $messages->each(function ($message) use ($sender) {
            $message->where('receiver_id', auth()->user()->id)
                ->where('sender_id', $sender->id)
                ->update(['is_read' => true]);
        });

        return $messages;
    }
}

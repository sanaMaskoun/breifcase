<?php
namespace App\Traits;

use App\Models\Message;

trait MessageCountTrait
{
    public function message_count($receiver_id)
    {
        return
        Message::where('receiver_id', Auth()->user()->id)->where('sender_id', $receiver_id)
            ->where('is_read', false)
            ->count();
    }
}

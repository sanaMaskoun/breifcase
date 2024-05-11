<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\Broadcaster;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CounterChatEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

public $sender_id;
public $receiver_id;
public $message_count;
public $message;
    public function __construct($message_count,$sender_id , $receiver_id ,$message)
    {
       $this->receiver_id = $receiver_id;
       $this->sender_id = $sender_id;
       $this->message_count = $message_count;
       $this->message = $message;
    }


    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('counter-chat-channel-'.$this->receiver_id)
        ];
    }
    public function broadcastAs()
    {
        return 'counterChat';
    }
}

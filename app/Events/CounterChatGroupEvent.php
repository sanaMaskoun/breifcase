<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CounterChatGroupEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $message_count;
    public $member_id;
    public $group_id;
        public function __construct($message_count,$member_id ,$group_id)
        {
           $this->member_id = $member_id;
           $this->group_id = $group_id;
           $this->message_count = $message_count;
        }

    public function broadcastOn()
    {
        return new PrivateChannel('counter-chat-group-channel-'.$this->member_id);


    }
    public function broadcastAs()
    {
        return 'counterChatGroup';
    }
}

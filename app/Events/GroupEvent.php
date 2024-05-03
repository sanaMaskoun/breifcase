<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GroupEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $sender_profile;
    public $sender_name;
    public $sender_id;
    public $message;
    public $attachment;
    public $created_at;
    public function __construct($sender_profile, $sender_name ,$sender_id, $message, $attachment, $created_at)
    {

        $this->sender_profile    = $sender_profile;
        $this->sender_name       = $sender_name;
        $this->sender_id         = $sender_id;
        $this->message           = $message;
        $this->attachment        = $attachment;
        $this->created_at        = $created_at;
    }

    public function broadcastOn(): array
    {
        return ['group-channel'];
    }
    public function broadcastAs()

    {
        return 'groupMessage';
    }
}

<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewChatEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $receiver_name;
    public $receiver_profile;
    public $receiver_id;
    public $receiver_encoded_id;
    public $sender_id;
    public $sender_encoded_id;
    public $sender_name;
    public $sender_profile;
    public $created_at;
    public $message_count;

    public function __construct($message, $receiver = [], $sender = [], $created_at, $message_count)
    {
        $this->message = $message;
        $this->receiver_id = $receiver['receiver_id'];
        $this->receiver_encoded_id = $receiver['receiver_encoded_id'];
        $this->receiver_name = $receiver['name'];
        $this->receiver_profile = $receiver['profile'];
        $this->sender_id = $sender['sender_id'];
        $this->sender_encoded_id = $sender['sender_encoded_id'];
        $this->sender_name = $sender['name'];
        $this->sender_profile = $sender['profile'];
        $this->created_at = $created_at;
        $this->message_count = $message_count;

    }

    public function broadcastOn()
    {
        return new PrivateChannel('new-chat-channel');

    }
    public function broadcastAs()
    {
        return 'newChatMessage';
    }
}

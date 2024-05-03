<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class chatPrivateEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $receiver;
    public $sender_id;
    public string $message;
    public string $created_at;
    public $attachment;

    public function __construct($receiver, $sender_id, $message, $attachment, $created_at)
    {
        $this->receiver = $receiver;
        $this->sender_id = $sender_id;
        $this->message = $message;
        $this->attachment = $attachment;
        $this->created_at = $created_at;

    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat-channel');

    }
    public function broadcastAs()
    {
        return 'chatMessage';
    }
}
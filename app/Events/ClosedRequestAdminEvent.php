<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ClosedRequestAdminEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $request_id;
    public $request_title;
    public $request_encode_id;
    public $created_at;

    public function __construct($data = [])
    {
        $this->request_id =$data['request_id'];
        $this->request_title = $data['request_title'];
        $this->request_encode_id = $data['request_encode_id'];
        $this->created_at = $data['created_at'];

    }

    public function broadcastOn()
    {
        return new PrivateChannel('closed-request-admin-channel') ;

    }
    public function broadcastAs()
    {
        return 'closedRequestAdmin';
    }
}

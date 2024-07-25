<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ClosedRequestClientEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $request_id;
    public $request_title;
    public $request_encode_id;
    public $client_id;
    public $created_at;


    public function __construct($data = [] ,$client_id)
    {
        $this->request_id =$data['request_id'];
        $this->request_title = $data['request_title'];
        $this->request_encode_id = $data['request_encode_id'];
        $this->created_at = $data['created_at'];

        $this->client_id = $client_id;

    }

    public function broadcastOn()
    {
        return new PrivateChannel('closed-request-client-channel-'.$this->client_id ) ;

    }
    public function broadcastAs()
    {
        return 'closedRequestClient';
    }
}

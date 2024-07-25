<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ClosedCaseClientEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $case_id;
    public $case_title;
    public $case_encode_id;
    public $client_id;
    public $created_at;


    public function __construct($data = [] ,$client_id)
    {
        $this->case_id =$data['case_id'];
        $this->case_title = $data['case_title'];
        $this->case_encode_id = $data['case_encode_id'];
        $this->created_at = $data['created_at'];

        $this->client_id = $client_id;

    }

    public function broadcastOn()
    {
        return new PrivateChannel('closed-case-client-channel-'.$this->client_id ) ;

    }
    public function broadcastAs()
    {
        return 'closedCaseClient';
    }
}

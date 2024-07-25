<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ClosedConsultationAdminEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $consultation_id;
    public $consultation_title;
    public $consultation_encode_id;
    public $created_at;

    public function __construct($data = [])
    {
        $this->consultation_id =$data['consultation_id'];
        $this->consultation_title = $data['consultation_title'];
        $this->consultation_encode_id = $data['consultation_encode_id'];
        $this->created_at = $data['created_at'];

    }

    public function broadcastOn()
    {
        return new PrivateChannel('closed-consultation-admin-channel') ;

    }
    public function broadcastAs()
    {
        return 'closedConsultationAdmin';
    }
}

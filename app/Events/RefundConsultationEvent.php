<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RefundConsultationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $consultation_id ;
    public $title;
    public $encodedId;
       public function __construct($data =[] , $encodedId)
    {
       $this->consultation_id = $data['consultation_id'];
       $this->title           = $data['title'];
       $this->encodedId       = $encodedId;
    }


    public function broadcastOn()
    {
        return new PrivateChannel('refund-consultation-channel') ;

    }
}

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
    public $consultation_encoded_id;
    // public $date;
       public function __construct($data =[] , $consultation_encoded_id )
    {
       $this->consultation_id               = $data['consultation_id'];
       $this->title                         = $data['title'];
    //    $this->date                          = $date;
       $this->consultation_encoded_id       = $consultation_encoded_id;
    }


    public function broadcastOn()
    {
        return new PrivateChannel('refund-consultation-channel') ;

    }
}

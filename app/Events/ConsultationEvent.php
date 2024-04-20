<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ConsultationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $client_id;
    public $client_name;
    public $consultation_id;
    public $consultation_title;
    public $date;
    public $time;
    public $lawyer;

    public function __construct($data = [],$lawyer)
    {
        $this->client_id          = $data['client_id'];
        $this->client_name        = $data['client_name'];
        $this->consultation_id    = $data['consultation_id'];
        $this->consultation_title = $data['consultation_title'];
        $this->lawyer             = $lawyer;
        $this->date               = date("j M Y", strtotime(Carbon::now()));
        $this->time               = date("h:i A", strtotime(Carbon::now()));

    }

    public function broadcastOn()
    {
        return new PrivateChannel('consultation-channel.'. $this->lawyer) ;

    }
}

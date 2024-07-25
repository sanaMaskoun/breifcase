<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RejectCaseEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $case_id;
    public $case_title;

    public $client_name;
    public $lawyer_id;
   public $case_encoded_id;

   public $date;
   public $time;
   public function __construct($data = [], $case_encoded_id , $lawyer_id)
   {
       $this->case_id          = $data['case_id'];
       $this->case_title       = $data['case_title'];
       $this->lawyer_id        = $lawyer_id;
       $this->client_name      = $data['client_name'];

       $this->case_encoded_id  = $case_encoded_id;

       $this->date             = date("j M Y", strtotime(Carbon::now()));
       $this->time             = date("h:i A", strtotime(Carbon::now()));

   }


    public function broadcastOn()
    {
        return new PrivateChannel('reject-channel-' . $this->lawyer_id);

    }
}

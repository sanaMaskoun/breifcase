<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CaseEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $case_id;
    public $case_title;
    public $date;
    public $time;
    public $client_id;
    public $case_encoded_id;
    public $lawyer_name;
    public function __construct($data = [], $case_encoded_id, $client_id)
    {
        $this->case_id          = $data['case_id'];
        $this->case_title       = $data['case_title'];
        $this->lawyer_name       = $data['lawyer_name'];
        $this->client_id        = $client_id;
        $this->case_encoded_id  = $case_encoded_id;

        $this->date             = date("j M Y", strtotime(Carbon::now()));
        $this->time             = date("h:i A", strtotime(Carbon::now()));

    }

    public function broadcastOn()
    {
        return new PrivateChannel('case-channel-' . $this->client_id);

    }
}

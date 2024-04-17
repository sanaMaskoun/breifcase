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

class ReplyRateEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $client_id;
    public $client_name;
    public $question_id;
    public $question;
    public $date;
    public $time;

    public function __construct($data = [])
    {
        $this->client_id   = $data['client_id'];
        $this->client_name = $data['client_name'];
        $this->question_id = $data['question_id'];
        $this->question    = $data['question'];
        $this->date        = date("j M Y", strtotime(Carbon::now()));
        $this->time        = date("h:i A", strtotime(Carbon::now()));

    }

    public function broadcastOn(): array
    {
        return ['rate-channel'];
    }
}

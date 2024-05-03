<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SuggestionEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user_id;
    public $email;
    public $user_name;
    public $title;
    public $date;
    public $time;

    public function __construct($data = [])
    {
        $this->user_id = $data['user_id'];
        $this->user_name = $data['user_name'];
        $this->title = $data['title'];
        $this->email = $data['email'];
        $this->date = date("j M Y", strtotime(Carbon::now()));
        $this->time = date("h:i A", strtotime(Carbon::now()));

    }

    public function broadcastOn()
    {
        return new PrivateChannel('suggestion-channel-'. $this->user_id) ;


    }
}

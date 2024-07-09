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

class NotificationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user_id;
    public $email;
    public $user_name;
    public $profile_image;

    public $date;
    public $user_encoded_id;
    public $time;

    public function __construct($data = [] , $user_encoded_id)
    {
        $this->user_id = $data['user_id'];
        $this->user_name = $data['user_name'];
        $this->profile_image = $data['profile_image'];
        $this->email = $data['email'];
        $this->user_encoded_id =$user_encoded_id;
        $this->date = date("j M Y", strtotime(Carbon::now()));
        $this->time = date("h:i A", strtotime(Carbon::now()));



    }

    public function broadcastOn()
    {
        return new PrivateChannel('notify-channel') ;
        // return ['notify-channel'];



    }

}

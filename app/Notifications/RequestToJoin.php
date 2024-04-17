<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RequestToJoin extends Notification
{
    use Queueable;
    private $user_id;
    private $joined_user;
    private $email;
    public $type = 'join';
    public function __construct($user_id ,$joined_user ,$email)
    {
        $this->user_id = $user_id;
        $this->joined_user = $joined_user;
        $this->email = $email;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }




    public function toArray(object $notifiable): array
    {
        return [
            'user_id'        => $this->user_id,
            'joined_user'    => $this->joined_user,
            'email'           => $this->email,
        ];
    }
}

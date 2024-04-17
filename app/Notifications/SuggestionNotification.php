<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SuggestionNotification extends Notification
{
    use Queueable;
private $title ;
private $user_id;
private $user_name;
private $email;
public $type = 'suggestion';


    public function __construct($data = [])
    {
        $this->title = $data['title'];
        $this->user_id = $data['user_id'];
        $this->user_name = $data['user_name'];
        $this->email = $data['email'];

    }


    public function via(object $notifiable): array
    {
        return ['database'];
    }


    public function toArray(object $notifiable): array
    {
        return [
            'user_id'      => $this->user_id,
            'title'        => $this->title,
            'user_name'    => $this->user_name,
            'email'    => $this->email,
        ];
    }
}

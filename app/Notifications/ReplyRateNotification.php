<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReplyRateNotification extends Notification
{
    use Queueable;

    private $client_id;
    private $client_name;
    private $question_id;
    private $question;
       public function __construct($data=[])
    {
        $this->client_id          = $data['client_id'];
        $this->client_name        = $data['client_name'];
        $this->question_id        = $data['question_id'];
        $this->question           = $data['question'];
    }



    public function via(object $notifiable): array
    {
        return ['database'];
    }


    public function toArray(object $notifiable): array
    {
        return [
            'client_id'             => $this->client_id,
            'client_name'           => $this->client_name,
            'question_id'           => $this->question_id,
            'question'              => $this->question,
        ];
    }
}

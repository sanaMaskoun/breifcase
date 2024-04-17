<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ConsultationNotification extends Notification
{
    use Queueable;

    private $client_id;
    private $client_name;
    private $consultation_id;
    private $consultation_title;
       public function __construct($data=[])
    {
        $this->client_id          = $data['client_id'];
        $this->client_name        = $data['client_name'];
        $this->consultation_id    = $data['consultation_id'];
        $this->consultation_title = $data['consultation_title'];
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
            'consultation_id'       => $this->consultation_id,
            'consultation_title'    => $this->consultation_title,
        ];
    }
}

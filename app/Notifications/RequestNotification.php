<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RequestNotification extends Notification
{
    use Queueable;

    private $client_id;
    private $client_name;
    private $document_id;
    private $document_title;
       public function __construct($data=[])
    {
        $this->client_id          = $data['client_id'];
        $this->client_name        = $data['client_name'];
        $this->document_id    = $data['document_id'];
        $this->document_title = $data['document_title'];
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
            'document_id'       => $this->document_id,
            'document_title'    => $this->document_title,
        ];
    }
}

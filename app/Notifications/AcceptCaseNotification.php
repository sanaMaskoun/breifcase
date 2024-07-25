<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AcceptCaseNotification extends Notification
{
    use Queueable;

    private $client_name;
    private $case_id;
    private $case_title;
       public function __construct($data=[])
    {
        $this->client_name        = $data['client_name'];
        $this->case_id            = $data['case_id'];
        $this->case_title         = $data['case_title'];
    }


    public function via(object $notifiable): array
    {
        return ['database'];
    }

 public function toArray(object $notifiable): array
    {
        return [
            'client_name'           => $this->client_name,
            'case_id'               => $this->case_id,
            'case_title'            => $this->case_title,
        ];
    }
}

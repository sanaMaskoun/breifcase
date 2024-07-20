<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CaseNotification extends Notification
{
    use Queueable;

    private $lawyer_id;
    private $lawyer_name;
    private $case_id;
    private $case_title;
       public function __construct($data=[])
    {
        $this->lawyer_id          = $data['lawyer_id'];
        $this->lawyer_name        = $data['lawyer_name'];
        $this->case_id    = $data['case_id'];
        $this->case_title = $data['case_title'];
    }


    public function via(object $notifiable): array
    {
        return ['database'];
    }

 public function toArray(object $notifiable): array
    {
        return [
            'lawyer_id'             => $this->lawyer_id,
            'lawyer_name'           => $this->lawyer_name,
            'case_id'               => $this->case_id,
            'case_title'            => $this->case_title,
        ];
    }
}

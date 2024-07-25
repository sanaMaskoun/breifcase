<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ClosedCaseAdminNotification extends Notification
{
    use Queueable;

    private $case_id;
    private $case_title;
    private $case_encode_id;
    private $created_at;

       public function __construct($data=[])
    {
        $this->case_id               = $data['case_id'];
        $this->case_title            = $data['case_title'];
        $this->case_encode_id         = $data['case_encode_id'];
        $this->created_at                    = $data['created_at'];
    }


    public function via(object $notifiable): array
    {
        return ['database'];
    }

 public function toArray(object $notifiable): array
    {
        return [
            'case_id'              => $this->case_id,
            'case_title'           => $this->case_title,
            'case_encode_id'        => $this->case_encode_id,
            'created_at'                   => $this->created_at,
        ];
    }
}

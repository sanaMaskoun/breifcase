<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ClosedConsultationAdminNotification extends Notification
{
    use Queueable;

    private $consultation_id;
    private $consultation_title;
    private $consultation_encode_id;
    private $created_at;

       public function __construct($data=[])
    {
        $this->consultation_id               = $data['consultation_id'];
        $this->consultation_title            = $data['consultation_title'];
        $this->consultation_encode_id         = $data['consultation_encode_id'];
        $this->created_at                    = $data['created_at'];
    }


    public function via(object $notifiable): array
    {
        return ['database'];
    }

 public function toArray(object $notifiable): array
    {
        return [
            'consultation_id'              => $this->consultation_id,
            'consultation_title'           => $this->consultation_title,
            'consultation_encode_id'        => $this->consultation_encode_id,
            'created_at'                   => $this->created_at,
        ];
    }
}

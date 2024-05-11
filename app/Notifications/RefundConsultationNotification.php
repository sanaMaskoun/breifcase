<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class RefundConsultationNotification extends Notification
{
    use Queueable;

    private $consultation_id;
    private $title;
    public function __construct($data = [])
    {
        $this->consultation_id = $data['consultation_id'];
        $this->title = $data['title'];
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'consultation_id' => $this->consultation_id,
            'title' => $this->title,
        ];
    }
}

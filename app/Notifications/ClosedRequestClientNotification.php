<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ClosedRequestClientNotification extends Notification
{
    use Queueable;

    private $request_id;
    private $request_title;
    private $request_encode_id;
    private $created_at;
    public function __construct($data = [])
    {
        $this->request_id = $data['request_id'];
        $this->request_title = $data['request_title'];
        $this->request_encode_id = $data['request_encode_id'];
        $this->created_at = $data['created_at'];
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'request_id'       => $this->request_id,
            'request_title'    => $this->request_title,
            'request_encode_id' => $this->request_encode_id,
            'created_at'            => $this->created_at,
        ];
    }
}

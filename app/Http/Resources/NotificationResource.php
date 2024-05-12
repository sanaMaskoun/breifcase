<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            // 'clientId'          => $this->data['client_id'],
            // 'clientName'        => $this->data['client_name'],
            // 'consultationId'    => $this->data['consultation_id'],
            // 'consultationTitle' => $this->data['consultation_title'],
            'data' => $this->data,

            'createdAt' => $this->created_at?->format('j M Y'),
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
        'id'                => $this->id,
        'invoiceId'         => $this->invoiceId,
        'status'            => $this->status,
        'created_at'         => $this->created_at?->format('Y m d'),

        'sender_id'         =>$this->whenLoaded('sender', function()
        {
            return new UserResource($this->sender);
        }),
        'receiver_id'       =>$this->whenLoaded('receiver', function()
        {
            return new UserResource($this->receiver);
        }),
        'consultation_id'    =>$this->whenLoaded('consultation', function()
        {
            return new ConsultationResource($this->consultation);
        }),
        ];
    }
}

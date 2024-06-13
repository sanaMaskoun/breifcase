<?php

namespace App\Http\Resources;

use App\Enums\InvoiceStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
        'id'                => $this->id,
        'invoiceId'         => $this->invoiceId,
        'invoiceValue'      => $this->invoice_value	,
        'status'            => InvoiceStatusEnum::getKey($this->status) ,
        'createdAt'         => $this->created_at?->format('Y m d'),

        'sender'          =>$this->whenLoaded('sender', function()
        {
            return new UserResource($this->sender);
        }),
        'receiver'        =>$this->whenLoaded('receiver', function()
        {
            return new UserResource($this->receiver);
        }),

        'consultation'     =>$this->whenLoaded('consultation', function()
        {
            return new ConsultationResource($this->consultation);
        }),

        'case'            => $this->whenLoaded('case', function ()
        {
            return CaseResource::collection($this->case);
        }),

        ];
    }
}

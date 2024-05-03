<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'message'            => $this->message,
            'attachment'         => $this->getFirstMediaUrl('attachments'),
            'sender'             => $this->whenLoaded('sender' , function()
            {
                return new UserResource($this->sender);
            }),
            'receiver'             => $this->whenLoaded('receiver' , function()
            {
                return new UserResource($this->receiver);
            })
        ];
    }
}

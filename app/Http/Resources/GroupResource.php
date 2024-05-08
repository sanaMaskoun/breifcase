<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name'     => $this->name,
            'is_admin' => $this->pivot->is_admin,
            'messeges' => $this->whenLoaded('messeges' , function()
            {
                return ChatResource::collection($this->messeges);
            })
        ];
    }
}

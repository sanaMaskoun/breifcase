<?php

namespace App\Http\Resources;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TemplateResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'template'        => $this->getFirstMediaUrl('template'),
            'createdAt'       => $this->created_at?->format('Y m d'),
            'user'            => $this->whenLoaded('user' , function ()
            {
                return new UserResource($this->user);
            })
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'news'              => $this->news,
            'createdAt'         => $this->created_at?->format('Y m d'),
            'img'               => $this->getFirstMediaUrl('news'),
            'admin'              => $this->whenLoaded('user' , function()
            {
                   return [
                    'name'       => $this->user->name,
                    'email'      => $this->user->email
                   ];
            })
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LibraryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'title'           => $this->title,
            'library'         => $this->getFirstMediaUrl('library'),
            'createdAt'       => $this->created_at?->format('Y m d'),
            'user'            => $this->whenLoaded('user' , function ()
            {
                return new UserResource($this->user);
            })
        ];
    }
}

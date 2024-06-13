<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FrequentlyQuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'title'             => $this->title,
            'short_description' => $this->short_description,
            'description'       => $this->description,
            'createdAt'         => $this->created_at?->format('Y m d'),

            'imag'              => $this->getFirstMediaUrl('frequently_question'),
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

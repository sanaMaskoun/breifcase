<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RepliesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                      => $this->id,
            'reply'                   => $this->reply,
            'rate'                    => $this->rate,
            'date'                    => $this->created_at?->format('d/m/Y'),

            'userResponse'            => $this->whenLoaded('user', function () {
                return new UserResource($this->user);
            }),
            'generalQuestion'         => $this->whenLoaded('general_question', function () {
                return new GeneralQuestionsResource($this->general_question->load('user'));
            })
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GeneralQuestionsResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'question'        => $this->question,
            'date'            => $this->created_at?->format('d/m/Y'),

            'isReply'         => $this->replies->isEmpty() ? false : true,
            'userRequest'      => $this->whenLoaded('user', function () {
                return   new UserResource($this->user);
            }),
            'replies'      => $this->whenLoaded('replies', function () {
                return   RepliesResource::collection($this->replies->load(['user']));
            })
        ];
    }
}

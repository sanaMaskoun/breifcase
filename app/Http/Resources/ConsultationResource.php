<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ConsultationResource extends JsonResource
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
            'description'     => $this->description,
            'status'          => $this->status,
            'createdOn'       => Carbon::parse($this->created_at)->format('Y-m-d'),

            'sender'          => new UserResource($this->whenLoaded('sender')),
            'receiver'        => new UserResource($this->whenLoaded('receiver')),
            'files'           =>  FileResource::collection($this->getMedia('file')) ,

        ];
    }
}

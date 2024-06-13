<?php

namespace App\Http\Resources;

use App\Enums\DocumentStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ConsultationResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'title'           => $this->title,
            'description'     => $this->description,
            'status'          => DocumentStatusEnum::getKey($this->status) ,
            'answer'          => $this->answer,
            'createdOn'       => Carbon::parse($this->created_at)->format('Y-m-d'),

            'sender'          => new UserResource($this->whenLoaded('sender')),
            'receiver'        => new UserResource($this->whenLoaded('receiver')),
            // 'translateFile'   => $this->getFirstMediaUrl('translateFile'),
            // 'files'           =>  FileResource::collection($this->getMedia('file')) ,

        ];
    }
}

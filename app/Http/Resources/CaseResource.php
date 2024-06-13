<?php

namespace App\Http\Resources;

use App\Enums\DocumentStatusEnum;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CaseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'title'           => $this->title,
            'description'     => $this->description,
            'status'          => DocumentStatusEnum::getKey($this->status),
            'answer'          => $this->answer,
            'createdOn'       => Carbon::parse($this->created_at)->format('Y-m-d'),

            'sender'          => new UserResource($this->whenLoaded('sender')),
            'receiver'        => new UserResource($this->whenLoaded('receiver')),
            'caseTemplate'    => $this->getFirstMediaUrl('case_template'),

        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->id,
            'name'     => $this->name,

            'admin'    => $this->whenLoaded('admin' , function()
            {

                return new UserResource($this->admin->first());
            }),
            'members' => $this->whenLoaded('members' , function()
            {
                return UserResource::collection($this->members);
            }),
            'messeges' => $this->whenLoaded('messeges' , function()
            {
                return ChatResource::collection($this->messeges);
            })
        ];
    }
}

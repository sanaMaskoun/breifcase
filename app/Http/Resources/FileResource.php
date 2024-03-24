<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"        =>  $this->id,
            "link"      => $this->original_url,
            "fileName"  => $this->file_name,
            "createdAt" => $this->created_at->format('Y-m-d'),
            "extension" => $this->mime_type
        ];
    }
}

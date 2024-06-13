<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RateResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            "communication"       => $this->communication,
            "responseTime"        => $this->response_time,
            "problemSolving"      => $this->problem_solving,
            "understanding"       => $this->understanding,
            "comment"             => $this->comment,
            "client"              => $this->whenLoaded('client', function () {
                return new UserResource($this->client);
            }),
            "lawyer"            => $this->whenLoaded('lawyer', function () {
                return new UserResource($this->lawyer);
            }),
            "consultation"            => $this->whenLoaded('consultation' , function()
            {
                return new ConsultationResource ($this->consultation);
            }),
            "case"            => $this->whenLoaded('case' , function()
            {
                return new CaseResource ($this->case);
            }),
        ];
    }
}

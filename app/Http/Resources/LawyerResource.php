<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LawyerResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return[
            'landLine'                => $this->land_line,
             'consultationPrice'      => $this->consultation_price,
             'location'               => $this->location,
             'yearsOfPractice'        => $this->years_of_practice,
             'available'              => $this->available == 0 ? false :true,
             'bio'                    => $this->bio,

             'certifications'          => $this->getMedia('certification')->map(function ($media) {
                return $media->getUrl();
            }),
             'licenses'                => $this->getMedia('license')->map(function ($media) {
                return $media->getUrl();
            }),

        ];
    }
}

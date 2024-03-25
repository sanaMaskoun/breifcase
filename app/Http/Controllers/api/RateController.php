<?php

namespace App\Http\Controllers\api;

use App\Enums\ConsultationStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\RateRequest;
use App\Http\Resources\RateResource;
use App\Models\Consultation;
use App\Models\Rate;
use Illuminate\Http\Request;

class RateController extends Controller
{
    public function rate(RateRequest $request , Consultation $consultation)
    {
           $rate = Rate::create($request->validated());
           $consultation->update(['status' => ConsultationStatusEnum::closed]);
           return response()->json(new RateResource($rate->load(['consultation' , 'client' , 'employee'])));
    }
}

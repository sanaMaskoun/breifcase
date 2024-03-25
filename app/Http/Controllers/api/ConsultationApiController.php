<?php

namespace App\Http\Controllers\api;

use App\Enums\ConsultationStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConsultationAnswerRequest;
use Illuminate\Http\Request;
use App\Http\Requests\ConsultationRequest;
use App\Http\Resources\ConsultationResource;
use App\Models\Consultation;
use App\Models\User;
use Carbon\Carbon;

class ConsultationApiController extends Controller
{
    public function store(ConsultationRequest $request, User $receiver)
    {
        $consultation = Consultation::create($request->validated());
        return response()->json(new ConsultationResource($consultation->load(['receiver', 'sender'])));
    }

    public function answer(ConsultationAnswerRequest $request, Consultation $consultation)
    {
        $consultationSentAt = $consultation->created_at;
        $timeDifference = Carbon::now()->diffInHours($consultationSentAt);
        if ($timeDifference <= 48) {

            $consultation->update([
                'answer'              => $request->answer,
                'status'              => ConsultationStatusEnum::ongoing,
            ]);
            return response()->json(new ConsultationResource($consultation->load(['receiver', 'sender'])));
        } else {
            return response()->json(['message' => 'Time has run out to answer this consultation']);
        }
    }
}

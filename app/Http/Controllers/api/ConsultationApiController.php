<?php

namespace App\Http\Controllers\api;

use App\Enums\ConsultationStatusEnum;
use App\Enums\DocumentStatusEnum;
use App\Events\ConsultationEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConsultationAnswerRequest;
use App\Http\Requests\ConsultationRequest;
use App\Http\Requests\RateRequest;
use App\Http\Resources\ConsultationResource;
use App\Http\Resources\RateResource;
use App\Models\Consultation;
use App\Models\Document;
use App\Models\Rate;
use App\Models\User;
use App\Notifications\ConsultationNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;

class ConsultationApiController extends Controller
{

    public function store(ConsultationRequest $request, User $receiver)
    {
        $consultation = Document::create($request->validated());


        $lawyer = User::where('id', $receiver->id)->first();
        $consultation_encoded_id = base64_encode($consultation->id);

        $data = [
            'client_id' => Auth()->user()->id,
            'client_name' => Auth()->user()->name,
            'consultation_id' => $consultation->id,
            'consultation_title' => $consultation->title,

        ];

        Notification::send($lawyer, new ConsultationNotification($data));
        event(new ConsultationEvent($data, $consultation_encoded_id ,$lawyer->id));

        return response()->json(new ConsultationResource($consultation->load(['receiver', 'sender'])));
    }

    public function answer(ConsultationAnswerRequest $request, Document $consultation)
    {
        $consultation_sent_at = $consultation->created_at;
        $time_difference = Carbon::now()->diffInHours($consultation_sent_at);

        if ($time_difference <=72) {

            $consultation->update([
                'answer' => $request->answer,
                'status' => DocumentStatusEnum::ongoing,

            ]);
            return response()->json(new ConsultationResource($consultation->load(['receiver', 'sender'])));
        } else {
            return response()->json(['message' => 'Time has run out to answer this consultation']);
        }
    }

    public function rate(RateRequest $request , Document $consultation)
    {
           $rate = Rate::create($request->validated());
           $consultation->update(['status' => DocumentStatusEnum::closed]);
           return response()->json(new RateResource($rate->load(['consultation' , 'client' , 'lawyer' , 'case'])));
    }
}

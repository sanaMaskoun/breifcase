<?php

namespace App\Http\Controllers;

use App\Enums\DocumentTypeEnum;
use App\Http\Requests\ConsultationAnswerRequest;
use App\Http\Requests\ConsultationRequest;
use App\Models\Consultation;
use App\Models\Document;
use App\Models\Rate;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ConsultationController extends Controller
{
    public function index($receiver_encoded_id = null)
    {
        if ($receiver_encoded_id != null) {
            $receiver_decoded_id = base64_decode($receiver_encoded_id);
            $lawyer = User::find($receiver_decoded_id);

            $consultations = Document::where('receiver_id', $lawyer->id)->where('type', DocumentTypeEnum::consultation)->get();
            $num_consultations = Document::where('receiver_id', $lawyer->id)->where('type', DocumentTypeEnum::consultation)->count();
        } else {
            $consultations = Document::where('type', DocumentTypeEnum::consultation)->get();
            $num_consultations = Document::where('type', DocumentTypeEnum::consultation)->count();

        }
        return view('pages.document.consultation.list', compact('consultations', 'num_consultations'));
    }
    public function create($receiver_encoded_id)
    {
        $receiver_decoded_id = base64_decode($receiver_encoded_id);

        $lawyer = User::find($receiver_decoded_id);
        return view('pages.document.consultation.create', compact('lawyer'));
    }
    public function store(ConsultationRequest $request, User $receiver)
    {
        Document::create($request->validated());

        $lawyer_encoded_id = base64_encode($receiver->id);
        return redirect()->route('show_lawyer', $lawyer_encoded_id);
    }
    public function show($consultaion_encode_id)
    {
        $consultaion_decode_id = base64_decode($consultaion_encode_id);
        $consultaion = Document::find( $consultaion_decode_id);

        return view('pages.document.consultation.show',compact('consultaion'));
    }
    public function reviews()
    {
        $rates = Rate::where('lawyer_id', auth()->user()->id)
            ->select(
                'comment', 'client_id', 'document_id',
                DB::raw('(understanding + problem_solving + response_time + communication) / 4 as average_rate')
            )
            ->get();

        return view('pages.document.consultation.reviews', compact('rates'));
    }
    public function answer(ConsultationAnswerRequest $request, Consultation $consultation)
    {
        $get_notify = DB::table('notifications')->where('data->consultation_id', $consultation->id)->where('notifiable_id', Auth()->user()->id)->first();
        if ($get_notify != null) {DB::table('notifications')->where('id', $get_notify->id)->update(['read_at' => now()]);}
        $consultationSentAt = $consultation->created_at;
        $timeDifference = Carbon::now()->diffInHours($consultationSentAt);
        if ($timeDifference <= 48) {

            $consultation->update([
                'answer' => $request->answer,
                // 'status' => ConsultationStatusEnum::ongoing,
            ]);
            return redirect()->route('show_consultation', base64_encode($consultation->id))
                ->with('success', __('message.success_answer'));
        } else {
            return redirect()->route('show_consultation', base64_encode($consultation->id))
                ->with('error', __('message.exceeded_answer_time'));
        }
    }
}

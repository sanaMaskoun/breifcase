<?php

namespace App\Http\Controllers;

use App\Enums\ConsultationStatusEnum;
use App\Http\Requests\ConsultationAnswerRequest;
use App\Models\Consultation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsultationController extends Controller
{
    public function index(Request $request ,$encodedId =null)
    {
        $decodedId = base64_decode($encodedId);
        $status = $request->query('status');
        if ($decodedId) {
            $user = User::find($decodedId);
            $role = $user->roles()->first()->name;

            $role == 'client' ? $consultations = Consultation::where('sender_id', $user->id)->paginate(config('constants.PAGINATION_COUNT')) : $consultations = Consultation::where('receiver_id', $user->id)->paginate(config('constants.PAGINATION_COUNT'));

        } else {
            $status == null ? $consultations = Consultation::paginate(config('constants.PAGINATION_COUNT')) : $consultations = Consultation::where('status', $status)->paginate(config('constants.PAGINATION_COUNT'));
        }

        return view('pages.consultation.list', compact('consultations'));
    }
    public function show($encodedId)
    {
        $decodedId = base64_decode($encodedId);
        $consultation = Consultation::find($decodedId);
        return view('pages.consultation.details', compact('consultation'));
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
                'status' => ConsultationStatusEnum::ongoing,
            ]);
            return redirect()->route('show_consultation', base64_encode($consultation->id))
                ->with('success', __('message.success_answer'));
        } else {
            return redirect()->route('show_consultation', base64_encode($consultation->id))
                ->with('error', __('message.exceeded_answer_time'));
        }
    }
}

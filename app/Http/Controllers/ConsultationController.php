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
    public function index(Request $request)
    {
        $user_id = $request->user;
        $status = $request->query('status');

        if ($user_id) {
            $user = User::find($user_id);
            $role = $user->roles()->first()->name;

            $role == 'client' ? $consultations = Consultation::where('sender_id', $user_id)->get() : $consultations = Consultation::where('receiver_id', $user_id)->get();

        } else {
            $status == null ? $consultations = Consultation::all() : $consultations = Consultation::where('status', $status)->get();
        }

        return view('pages.consultation.list', compact('consultations'));
    }
    public function show(Consultation $consultation)
    {
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
            return redirect()->route('show_consultation', $consultation->id)
                ->with('success', 'The response has been sent successfully');
        } else {
            return redirect()->route('show_consultation', $consultation->id)
                ->with('error', 'Time has run out to answer this consultation');
        }
    }
}

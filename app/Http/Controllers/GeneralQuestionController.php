<?php

namespace App\Http\Controllers;

use App\Models\GeneralQuestion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeneralQuestionController extends Controller
{
    public function index(Request $request, $question_encoded_id = null)
    {
        $question_decoded_id = base64_decode($question_encoded_id);

        if ($question_decoded_id) {
            $user = User::find($question_decoded_id);
            $role = $user->roles()->first()->name;

            if ($role == 'client') {
                $questions = GeneralQuestion::where('user_id', $user->id)->paginate(config('constants.PAGINATION_COUNT'));
            } else {
                $questions = GeneralQuestion::paginate(config('constants.PAGINATION_COUNT'));
            }
        } else {
            $questions = GeneralQuestion::paginate(config('constants.PAGINATION_COUNT'));
        }

        return view('pages.generalQuestion.list', compact('questions'));
    }
    public function show($question_encoded_id)
    {
        $question_decoded_id = base64_decode($question_encoded_id);
        $general_question = GeneralQuestion::find($question_decoded_id);

        $get_notify = DB::table('notifications')->where('data->question_id', $general_question->id)->where('notifiable_id', Auth()->user()->id)->first();
        if ($get_notify != null) {DB::table('notifications')->where('id', $get_notify->id)->update(['read_at' => now()]);}
        return view('pages.generalQuestion.details', compact('general_question'));
    }
}

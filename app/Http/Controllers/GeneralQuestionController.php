<?php

namespace App\Http\Controllers;

use App\Http\Requests\GeneralQuestionRequest;
use App\Models\GeneralQuestion;
use App\Models\User;
use Illuminate\Http\Request;

class GeneralQuestionController extends Controller
{
    public function index(Request $request, $user_encoded_id = null)
    {
        $user_decoded_id = base64_decode($user_encoded_id);

        if ($user_decoded_id) {
            $client = User::find($user_decoded_id);

            $questions = GeneralQuestion::where('sender_id', Auth()->user()->id)->get();
            return view('pages.generalQuestion.profileList', compact('questions', 'client'));

        } else {
            $questions = GeneralQuestion::paginate(config('constants.PAGINATION_COUNT'));
            return view('pages.generalQuestion.list', compact('questions'));

        }

    }

    public function create()
    {
        $client = Auth()->user();
         return view('pages.generalQuestion.create', compact('client'));
    }


    public function store(GeneralQuestionRequest $request)
    {
           GeneralQuestion::create($request->validated());
           $user_encoded_id = base64_encode(Auth()->user()->id);

           return redirect()->route('list_general_questions' , $user_encoded_id);
    }


    // public function show($question_encoded_id)
    // {
    //     $question_decoded_id = base64_decode($question_encoded_id);
    //     $general_question = GeneralQuestion::find($question_decoded_id);

    //     $get_notify = DB::table('notifications')->where('data->question_id', $general_question->id)->where('notifiable_id', Auth()->user()->id)->first();
    //     if ($get_notify != null) {DB::table('notifications')->where('id', $get_notify->id)->update(['read_at' => now()]);}
    //     return view('pages.generalQuestion.details', compact('general_question'));
    // }
}

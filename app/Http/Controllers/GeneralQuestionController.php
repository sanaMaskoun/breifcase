<?php

namespace App\Http\Controllers;

use App\Models\QuestionReply;
use Illuminate\Http\Request;
use App\Models\GeneralQuestion;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class GeneralQuestionController extends Controller
{
    public function index(Request $request)
    {
        $user_id = $request->user;

        if($user_id)
        {
            $user = User::find($user_id);
            $role = $user->roles()->first()->name;

            if($role == 'client')
            {
                $questions=GeneralQuestion::where('user_id',$user_id)->get();
            }
            else
            {
                $questions = GeneralQuestion::whereHas('Replies' , function($query) use($user_id)
                {
                    $query->where('user_id' , $user_id);
                })->get();
            }
        }
        else
        {
            $questions=GeneralQuestion::all();
        }


      return view('pages.generalQuestion.list',compact('questions'));
    }
    public function show(GeneralQuestion $general_question)
    {
        $get_notify = DB::table('notifications')->where('data->question_id', $general_question->id)->where('notifiable_id' , Auth()->user()->id)->first();
        if ($get_notify <> null ) {DB::table('notifications')->where('id', $get_notify->id)->update(['read_at' => now()]);
}
        return view('pages.generalQuestion.details', compact('general_question'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\QuestionReply;
use Illuminate\Http\Request;
use App\Models\GeneralQuestion;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class GeneralQuestionController extends Controller
{
    public function index(Request $request, $encodedId =null)
    {
        $decodedId = base64_decode($encodedId);

        if($decodedId)
        {
            $user = User::find($decodedId);
            $role = $user->roles()->first()->name;

            if($role == 'client')
            {
                $questions=GeneralQuestion::where('user_id',$user->id)->paginate(config('constants.PAGINATION_COUNT'));
            }
            else
            {
                $questions = GeneralQuestion::whereHas('Replies' , function($query) use($user)
                {
                    $query->where('user_id' , $user->id);
                })->paginate(config('constants.PAGINATION_COUNT'));
            }
        }
        else
        {
            $questions=GeneralQuestion::paginate(config('constants.PAGINATION_COUNT'));
        }


      return view('pages.generalQuestion.list',compact('questions'));
    }
    public function show($encodedId)
    {
        $decodedId = base64_decode($encodedId);
        $general_question = GeneralQuestion::find($decodedId);
        $get_notify = DB::table('notifications')->where('data->question_id', $general_question->id)->where('notifiable_id' , Auth()->user()->id)->first();
        if ($get_notify <> null ) {DB::table('notifications')->where('id', $get_notify->id)->update(['read_at' => now()]);
}
        return view('pages.generalQuestion.details', compact('general_question'));
    }
}

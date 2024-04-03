<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneralQuestion;
use App\Models\User;

class GeneralQuestionController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user;
        if($user)
        {
            $questions=GeneralQuestion::where('user_id',$user)->get();
        }
        else
        {  
            $questions=GeneralQuestion::all();
        }  
      return view('pages.generalQuestion.list',compact('questions'));
    }
    public function show(GeneralQuestion $general_question)
    {
        return view('pages.generalQuestion.details', compact('general_question'));
    }
}

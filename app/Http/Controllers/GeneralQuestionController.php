<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneralQuestion;


class GeneralQuestionController extends Controller
{
    public function index()
    {
        $questions=GeneralQuestion::all();
        return view('pages.generalQuestion.list',compact('questions'));
    }
    public function show(GeneralQuestion $general_question)
    {
        return view('pages.generalQuestion.details', compact('general_question'));
    }
}

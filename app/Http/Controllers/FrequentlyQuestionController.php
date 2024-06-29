<?php

namespace App\Http\Controllers;

use App\Http\Resources\FrequentlyQuestionResource;
use App\Models\FrequentlyQuestion;
use Illuminate\Http\Request;

class FrequentlyQuestionController extends Controller
{
    public function index()
    {
        $frequently_questions = FrequentlyQuestion::all();
        return view('pages.frequentlyQuestion.list' , compact('frequently_questions'));
    }

}

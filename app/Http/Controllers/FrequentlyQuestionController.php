<?php

namespace App\Http\Controllers;

use App\Http\Resources\FrequentlyQuestionResource;
use App\Models\FrequentlyQuestion;
use Illuminate\Http\Request;

class FrequentlyQuestionController extends Controller
{

    public function page()
    {
        return view('pages.frequentlyQuestion.content');
    }

}

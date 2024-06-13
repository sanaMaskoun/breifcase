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
        return response()->json(FrequentlyQuestionResource::collection($frequently_questions->load('user')));
    }
}

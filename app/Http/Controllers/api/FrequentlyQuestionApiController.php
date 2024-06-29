<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FrequentlyQuestionResource;
use App\Models\FrequentlyQuestion;
use Illuminate\Http\Request;

class FrequentlyQuestionApiController extends Controller
{
    public function index()
    {
        $frequently_questions = FrequentlyQuestion::all();
        return response()->json(FrequentlyQuestionResource::collection($frequently_questions->load('user')));
    }
}

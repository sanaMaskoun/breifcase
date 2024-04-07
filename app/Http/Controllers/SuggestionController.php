<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuggestionRequest;
use App\Http\Resources\SuggestionResource;
use App\Models\Suggestion;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{

    public function index()
    {
        $suggestions = Suggestion::all();
        return view('pages.suggestion',compact('suggestions'));

    }
   public function store(SuggestionRequest $request)
   {
             $suggestion = Suggestion::Create($request->validated());
             return new SuggestionResource($suggestion->load('user'));
   }
}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LanguageResource;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageApiController extends Controller
{
    public function index()
    {
      $languages = Language::all();
     return response()->json(LanguageResource::collection($languages),
     );
    }
}

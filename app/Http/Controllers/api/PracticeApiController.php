<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PracticeResource;
use App\Models\Practice;
use Illuminate\Http\Request;

class PracticeApiController extends Controller
{
   public function index()
   {
     $practices = Practice::all();
    return response()->json(PracticeResource::collection($practices),
    );
   }
}

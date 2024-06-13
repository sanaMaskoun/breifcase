<?php

namespace App\Http\Controllers;

use App\Events\SuggestionEvent;
use App\Http\Requests\SuggestionRequest;
use App\Http\Resources\SuggestionResource;
use App\Models\Suggestion;
use App\Models\User;
use App\Notifications\SuggestionNotification;
use Illuminate\Support\Facades\Notification;

class SuggestionController extends Controller
{

    public function index()
    {
        $suggestions = Suggestion::paginate(config('constants.PAGINATION_COUNT'));
        return view('pages.suggestion', compact('suggestions'));

    }
   
}

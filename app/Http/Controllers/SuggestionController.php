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
        $num_suggestions = Suggestion::count();
        return view('pages.suggestion.list', compact('suggestions','num_suggestions'));

    }


    public function show($suggestion_encode_id)
    {

        $suggestion_decode_id = base64_decode($suggestion_encode_id);
        $suggestion = Suggestion::find($suggestion_decode_id);
        return view('pages.suggestion.show', compact('suggestion'));
    }

}

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
        $suggestions = Suggestion::paginate(PAGINATION_COUNT);
        return view('pages.suggestion', compact('suggestions'));

    }
    public function store(SuggestionRequest $request)
    {
        $admins = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();

        $data = [
            'user_id' => Auth()->user()->id,
            'user_name' => Auth()->user()->name,
            'email' => Auth()->user()->email,
            'title' => $request->title,

        ];

        Notification::send($admins, new SuggestionNotification($data));
        event(new SuggestionEvent($data));

        $suggestion = Suggestion::Create($request->validated());
        return new SuggestionResource($suggestion->load('user'));
    }
}

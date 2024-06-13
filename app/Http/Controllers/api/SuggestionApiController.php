<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Events\SuggestionEvent;
use App\Http\Requests\SuggestionRequest;
use App\Http\Resources\SuggestionResource;
use App\Models\Suggestion;
use App\Models\User;
use App\Notifications\SuggestionNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;

class SuggestionApiController extends Controller
{

    public function index()
    {
        $suggestion = Suggestion::all();
        return  SuggestionResource::collection($suggestion->load('user'));



    }
    public function store(SuggestionRequest $request)
    {
        $suggestion = Suggestion::Create($request->validated());

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

        return new SuggestionResource($suggestion->load('user'));
    }
}

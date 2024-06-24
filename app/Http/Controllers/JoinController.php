<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class JoinController extends Controller
{
    public function join_lawyer()
    {

    }
    public function store_join_lawyer()
    {

    }
    public function join_client()
    {

        return view('pages.client.auth.join');
    }
    public function store_join_client(ClientRequest $request)
    {
        $user = User::create($request->userValidated());
        $user->client()->create($request->clientValidated());


        if (!empty($request->file('profile'))) {
             $user->addMedia($request->file('profile'))->toMediaCollection('profile');
        }
        $user->addMedia($request->file('front_emirates_id'))->toMediaCollection('front_emirates_id');

        $user->addMedia($request->file('back_emirates_id'))->toMediaCollection('back_emirates_id');
        Auth::login($user);

        return redirect()->route('home');
    }
    public function join_translation_company()
    {

    }
    public function store_join_translation_company()
    {

    }
}

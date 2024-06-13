<?php

namespace App\Http\Controllers\api;

use App\Enums\UserTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class ClientApiController extends Controller
{

    public function index()
    {
        $clients = User::where('type' , UserTypeEnum::client)->whereHas('general_questions')->get();
        return response()->json(UserResource::collection($clients->load('general_questions')));
    }
    public function show(User $user)
    {
        return response()->json(new UserResource($user->load([
            'client',
            'consultations_sender',
            'cases_sender',
            'invoice_sender',
            'general_questions.replies',
            'general_questions.user'
        ])));
    }


    public function update(ClientRequest $request, User $user)
    {
        $user->update($request->userValidated());
        $user->client()->update($request->clientValidated());

        if (empty($request->profile)) {
            $user->clearMediaCollection('profile');
            // $user->addMedia($request->profile)->toMediaCollection('profile');
        }
        if (!empty($request->profile)) {
            // $user->clearMediaCollection('profile');
            $user->addMedia($request->profile)->toMediaCollection('profile');
        }
        $user->clearMediaCollection('front_emirates_id');
        $user->addMedia($request->front_emirates_id)->toMediaCollection('front_emirates_id');

        $user->clearMediaCollection('back_emirates_id');
        $user->addMedia($request->back_emirates_id)->toMediaCollection('back_emirates_id');

        return response()->json(new UserResource($user->load('client')));

    }
}

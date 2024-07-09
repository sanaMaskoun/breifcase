<?php

namespace App\Http\Controllers\api;

use App\Enums\UserTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralChatApiRequest;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use App\Models\User;

class GeneralChatApiController extends Controller
{

    public function index (User $user)
    {

        $general_chats = $user->general_chats;
        return GroupResource::collection($general_chats->load(['members', 'admin']));

    }
    public function store(GeneralChatApiRequest $request)
    {
        if (Auth()->user()->type != UserTypeEnum::admin) {

            return response()->json(['message' => 'This role does not have the authority to add public chat']);
        } else {
            $general_chat = Group::create($request->validated());

            $user_id = auth()->id();

            $general_chat->users()->attach($user_id, ['is_admin' => true]);

            if ($request->members) {
                $general_chat->members()->attach($request->members);
            }
            if ($request->role) {

                $role = $request->role == 1 ? 'lawyer' : 'translation_company';

                $members = User::where('is_active', true)->whereHas('roles', function ($query) use ($role) {
                    return $query->where('name', $role);
                })->get();

                $general_chat->members()->attach($members);
            }
            return new GroupResource($general_chat->load(['members', 'admin']));
        }
    }

    public function update(GeneralChatApiRequest $request, Group $general_chat)
    {

        if (Auth()->user()->type != UserTypeEnum::admin) {

            return response()->json(['message' => 'This role does not have the authority to add public chat']);
        } else {
            $general_chat->update($request->validated());

            if ($request->members) {
                $general_chat->members()->sync($request->members);
            }

            if ($request->role) {

                $role = $request->role == 1 ? 'lawyer' : 'translator';

                $members = User::where('is_active', true)->whereHas('roles', function ($query) use ($role) {
                    return $query->where('name', $role);
                })->get();

                $general_chat->members()->sync($members);
            }
            return new GroupResource($general_chat->load(['members', 'admin']));

        }
    }
}

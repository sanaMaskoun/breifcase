<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use App\Models\User;

class GroupApiController extends Controller
{
    public function index (User $user)
    {

        $groups = $user->groups;
        return GroupResource::collection($groups->load(['members', 'admin']));

    }
    public function store(GroupRequest $request)
    {
        $group = Group::create($request->validated());

        $user_id = auth()->id();

        $group->users()->attach($user_id, ['is_admin' => true]);

        if ($request->members) {
            $group->users()->attach($request->members);
        }
        return new GroupResource($group->load(['members', 'admin']));

    }

    public function update(GroupRequest $request, Group $group)
    {
        $group->update($request->validated());
        if ($request->members) {
            $group->members()->sync($request->members);
        }
        return new GroupResource($group->load(['members', 'admin']));

    }
}

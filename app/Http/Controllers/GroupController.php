<?php

namespace App\Http\Controllers;

use App\Enums\UserTypeEnum;
use App\Http\Requests\GroupRequest;
use App\Models\Group;
use App\Models\User;

class GroupController extends Controller
{

    public function get_users()
    {
        return User::where('is_active', true)
            ->where('id', '<>', Auth()->user()->id)
            ->whereIn('type', [UserTypeEnum::lawyer, UserTypeEnum::admin])
            ->get();
    }
    public function create()
    {
        $users = $this->get_users();
        return view('pages.group.create', compact('users'));
    }

    public function store(GroupRequest $request)
    {
        $group = Group::create($request->validated());

        $user_id = Auth()->user()->id;
        $group->users()->attach($user_id, ['is_admin' => true]);

        if ($request->filled('members')) {
            $member_ids = explode(',', $request->members);
            $group->users()->attach($member_ids);
        }

        return redirect()->route('group');
    }

    public function edit($group_encoded_id)
    {
        $group_decoded_id = base64_decode($group_encoded_id);
        $group = Group::find($group_decoded_id);

        $users = $this->get_users();
        $members = $group->members;
        return view('pages.group.edit', compact(['group', 'users', 'members']));
    }

    public function update(GroupRequest $request, Group $group)
    {
        $group->update($request->validated());

        if ($request->filled('members')) {
            $member_ids = explode(',', $request->members);
            $group->users()->sync($member_ids);
        }

        $user_id = auth()->id();
        $group->users()->syncWithoutDetaching([$user_id => ['is_admin' => true]]);

        $group_encoded_id = base64_encode($group->id);

        return redirect()->route('group_form', $group_encoded_id);
    }
}

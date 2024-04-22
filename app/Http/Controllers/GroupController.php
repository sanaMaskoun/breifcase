<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupRequest;
use App\Models\Group;
use App\Models\User;

class GroupController extends Controller
{

    public function get_members()
    {
        return User::where('is_active', true)
        ->where('id', '<>', Auth()->user()->id)
        ->whereHas('roles', function ($query) {
            $query->whereIn('name', ['lawyer', 'legalConsultant', 'typingCenter']);
        })
        ->get();
    }
    public function create()
    {
        $members = $this->get_members();
        return view('pages.group.create', compact('members'));
    }

    public function store(GroupRequest $request)
    {
        $group = Group::create($request->validated());

        $user_id = auth()->id();

        $group->users()->attach($user_id, ['is_admin' => true]);

        if ($request->filled('members')) {
            $group->users()->attach($request->members);
        }

        return  redirect()->route('add_group')
            ->with('success', 'add successfully');
    }

    public function edit(Group $group)
    {
        $members = $this->get_members();

        return view('pages.group.edit',compact(['group','members']));
    }

    public function update(GroupRequest $request , Group $group)
    {
        $updatedMembers = $request->members;
        $updatedMembers[] = auth()->user()->id;

        $group->update($request->validated());
        $group->users()->sync($updatedMembers);
        return  redirect()->route('group_form',$group->id)
        ->with('success', 'add successfully');
    }
}

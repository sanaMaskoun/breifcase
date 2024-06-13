<?php

namespace App\Http\Controllers;

use App\Enums\GroupTypeEnum;
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
            $query->whereIn('name', ['lawyer', 'legalConsultant', 'typingCenter', 'translator']);
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

        return  redirect()->route('add_general_chat')
            ->with('success', __('message.success'));
    }

    public function edit($encodedId)
    {
        $decodedId = base64_decode($encodedId);
        $group = Group::find($decodedId);

        $members = $this->get_members();

        return view('pages.group.edit',compact(['group','members']));
    }

    public function update(GroupRequest $request , Group $group)
    {

        $group->update($request->validated());
        $group->members()->sync($request->members);

        $encodedId = base64_encode($group->id);

        return  redirect()->route('group_form',$encodedId)
        ->with('success', __('message.edit'));
    }
}

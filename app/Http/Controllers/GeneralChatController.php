<?php

namespace App\Http\Controllers;

use App\Http\Requests\GeneralChatRequest;
use App\Http\Requests\GroupRequest;
use App\Models\Group;
use App\Models\User;

class GeneralChatController extends Controller
{
    public function get_members()
    {
        return User::where('is_active', true)
            ->where('id', '<>', Auth()->user()->id)
            ->whereHas('roles', function ($query) {
                $query->whereIn('name', ['lawyer', 'translator']);
            })
            ->get();
    }
    public function create()
    {
        $members = $this->get_members();
        return view('pages.generalChat.create', compact('members'));
    }

    public function store(GeneralChatRequest $request)
    {
        $general_chat = Group::create($request->validated());
        $user_id = auth()->id();

        $general_chat->users()->attach($user_id, ['is_admin' => true]);

        if ($request->filled('members')) {

            $general_chat->users()->attach($request->members);
        }
        if ($request->filled('role')) {
            $role = $request->role == 1 ? 'lawyer' : 'translator';
            $members = User::where('is_active', true)->whereHas('roles', function ($query) use ($role) {
                return $query->where('name', $role);
            })->get();
            $general_chat->users()->attach($members);
        }
        return redirect()->route('add_general_chat')
            ->with('success', __('message.success'));
    }

    public function edit($encoded_general_chat)
    {
        $decoded_general_chat = base64_decode($encoded_general_chat);
        $group = Group::find($decoded_general_chat);

        $members = $this->get_members();

        return view('pages.generalChat.edit', compact(['group', 'members']));
    }

    public function update(GeneralChatRequest $request, Group $general_chat)
    {

        $general_chat->update($request->validated());

        if ($request->filled('members')) {
            $general_chat->members()->sync($request->members);

        }
        if ($request->filled('role'))
        {
            $role = $request->role == 1 ? 'lawyer' : 'translator';
            $members = User::where('is_active', true)->whereHas('roles', function ($query) use ($role) {
                return $query->where('name', $role);
            })->pluck('id');
            $members[] = auth()->user()->id;
            $general_chat->members()->sync($members);
        }


        $encoded_general_chat_id = base64_encode($general_chat->id);

        return redirect()->route('group_form', $encoded_general_chat_id)
            ->with('success', __('message.edit'));
    }
}

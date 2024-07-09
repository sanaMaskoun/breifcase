<?php

namespace App\Http\Controllers;

use App\Enums\UserTypeEnum;
use App\Http\Requests\GeneralChatRequest;
use App\Models\Group;
use App\Models\User;

class GeneralChatController extends Controller
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
        return view('pages.generalChat.create', compact('users'));
    }

    public function store(GeneralChatRequest $request)
    {
        $general_chat = Group::create($request->validated());

        $user_id = Auth()->user()->id;
        $general_chat->users()->attach($user_id, ['is_admin' => true]);

        if ($request->filled('members')) {
            $member_ids = explode(',', $request->members);
            $general_chat->users()->attach($member_ids);
        }

        return redirect()->route('general_chat');


    }

    public function edit($general_chat_encoded_id)
    {
        $general_chat_decoded_id = base64_decode($general_chat_encoded_id);
        $general_chat = Group::find($general_chat_decoded_id);

        $users = $this->get_users();
        $members = $general_chat->members;

        return view('pages.generalChat.edit', compact(['general_chat', 'users','members']));
    }

    public function update(GeneralChatRequest $request, Group $general_chat)
    {

        $general_chat->update($request->validated());

        if ($request->filled('members')) {
            $member_ids = explode(',', $request->members);
            $general_chat->users()->sync($member_ids);
        }

        $user_id = auth()->id();
        $general_chat->users()->syncWithoutDetaching([$user_id => ['is_admin' => true]]);

        $general_chat_encoded_id = base64_encode($general_chat->id);

        return redirect()->route('general_chat_form', $general_chat_encoded_id);
    }
}

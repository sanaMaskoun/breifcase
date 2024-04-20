<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{

    public function getUsersForChat()
    {
        $users = User::where('is_active', true)
            ->where('id', '<>', Auth()->user()->id)
            ->whereHas('roles', function ($query) {
                $query->whereIn('name', ['lawyer', 'legalConsultant', 'client', 'typingCenter']);
            })
            ->whereHas('sender_message', function ($query) {
                $query->where('receiver_id', Auth()->user()->id);
            })
            ->orWhereHas('receiver_message', function ($query) {
                $query->where('sender_id', Auth()->user()->id);
            })
            ->get();

        $users->each(function ($user) {
            $latestMessage = Message::where('sender_id', auth()->user()->id)
                ->where('receiver_id', $user->id)
                ->orWhere(function ($query) use ($user) {
                    $query->where('sender_id', $user->id)
                        ->where('receiver_id', auth()->user()->id);
                })
                ->latest()
                ->first();

            $user->latest_message = $latestMessage;
        });
        return $users;
    }
    public function chat(Request $request)
    {
        $groups = User::find(Auth()->user()->id)->groups;

        $name = $request->query('name');

        $lawyers = $this->getLawyers();

        $users = ($name != null) ? $this->getFilteredLawyersByName($name) : $this->getUsersForChat();

        session(['users' => $users, 'groups' => $groups, 'lawyers' => $lawyers]);

        return view('pages.chat.chat', compact(['users', 'groups', 'lawyers']));
    }

    public function getLawyers()
    {
        return User::where('is_active', true)
            ->where('id', '<>', Auth()->user()->id)
            ->whereHas('roles', function ($query) {
                $query->whereIn('name', ['lawyer', 'legalConsultant', 'typingCenter']);
            })
            ->get();
    }

    public function getFilteredLawyersByName($name)
    {
        return User::where('is_active', true)
            ->where('id', '<>', Auth()->user()->id)
            ->whereHas('roles', function ($query) {
                $query->whereIn('name', ['lawyer', 'legalConsultant', 'typingCenter']);
            })
            ->where('name', 'like', '%' . $name . '%')
            ->get();
    }

    public function chat_form(User $receiver)
    {
        $users = session('users');
        $groups = session('groups');
        $lawyers = session('lawyers');

        $messages = Message::where('sender_id', auth()->user()->id)
            ->where('receiver_id', $receiver->id)
            ->orWhere(function ($query) use ($receiver) {
                $query->where('sender_id', $receiver->id)
                    ->where('receiver_id', auth()->user()->id);
            })
            ->get();
        $role_receiver = $receiver->getRoleNames()->first();

        return view('pages.chat.formChat', compact(['receiver', 'lawyers', 'groups', 'messages', 'users', 'role_receiver']));
    }

    public function group_form(Group $group)
    {
        $users = session('users');
        $groups = session('groups');
        $lawyers = session('lawyers');
        $messages = Message::where('group_id', $group->id)->get();
        $members = User::whereHas('groups', function ($query) use ($group) {
            $query->where('groups.id', $group->id);
        })->get();

        return view('pages.chat.formGroup', compact(['lawyers', 'groups', 'users', 'messages', 'members', 'group']));

    }

    public function send_message_to_user(Request $request, User $receiver)
    {
        $message = new Message();
        $message->sender_id = auth()->user()->id;
        $message->receiver_id = $receiver->id;
        $message->message = $request->input('message');
        $message->save();

        return redirect()->back();
    }

    public function send_message_to_group(Request $request, Group $group)
    {
        $message = new Message();
        $message->sender_id = auth()->user()->id;
        $message->group_id = $group->id;
        $message->message = $request->input('message');
        $message->save();

        return redirect()->back();
    }
}

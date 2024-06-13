<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{

    public function get_messages()
    {

        return new UserResource(auth()->user()->load(['receiver_message', 'sender_message']));

    }
}

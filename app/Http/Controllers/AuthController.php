<?php

namespace App\Http\Controllers;

use App\Enums\RolesEnum;
use App\Events\NotificationEvent;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Notifications\RequestToJoin;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

   
}

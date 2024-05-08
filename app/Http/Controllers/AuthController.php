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

    public function register(Request $request)
    {
        $roleValue = intval($request->role);
        $role = RolesEnum::getKey($roleValue);
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
            'password_confirmation' => ['required', 'same:password'],
            'phone' => ['required', 'numeric', 'digits_between:7,14'],
            'role' => ['required', Rule::in([RolesEnum::client, RolesEnum::Lawyer, RolesEnum::legalConsultant, RolesEnum::typingCenter])],
        ]);
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'is_active' => false,
            'password' => bcrypt($request->password),
        ]);



        if ($user->save()) {
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->plainTextToken;

            $user->assignRole($role);

            if ($role == 'client') {
                $user->update(['is_active' => true]);
            }
            else
            {
                $admins = User::whereHas('roles', function ($query) {
                    $query->where('name', 'admin');
                })->get();

                $joined_user = $request->name;
                $email = $request->email;
                $encodedId = base64_encode($user->id);

                Notification::send($admins,new RequestToJoin($user->id , $joined_user ,$email));
                $data =[
                    'user_id' => $user->id,
                    'user_name'  => $request->name,
                    'email'  => $request->email,
                    'profile_image' => $user->getFirstMediaUrl('profileUser')

               ];
                event(new NotificationEvent($data , $encodedId));



            }

            return response()->json([
                'message' => 'Successfully created user!',
                'accessToken' => $token,
                'user' => $user,
            ], 201);
        } else {
            return response()->json(['error' => 'Provide proper details']);
        }
    }

    public function login(Request $request)
    {

        $this->validateLogin($request);

        $user = User::query()->where($this->username(), $request->input($this->username()))->first();
        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            throw ValidationException::withMessages([
                $this->username() => [trans('message.loginError')],
            ]);
        }

        $tokenResult = $user->createToken('Personal Access Token');

        if ($token = $tokenResult->plainTextToken) {
            return $this->sendLoginResponse($request, $user, $token);
        }

        return $this->sendFailedLoginResponse($request);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|email',
            'password' => 'required|string|min:8|max:20',
        ], [
            'password.required' => trans('validation.requiredPass'),
            'password.min' => trans('validation.minPassword'),
            'password.max' => trans('validation.maxPassword'),
            'email.required' => trans('validation.requiredEmail'),
            'email.email' => trans('validation.email'),
        ]);
    }

    public function username()
    {
        return 'email';
    }

    protected function sendLoginResponse(Request $request, $user, $token)
    {

        return new JsonResponse([
            'access_token' => $token,
            'user'         => new UserResource($user->load(['consultations', 'GeneralQuestions', 'QuestionsReplies', 'practices' , 'groups' , 'receiver_message' , 'sender_message'])),

        ]);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    public function logout(Request $request)
    {

        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }
}

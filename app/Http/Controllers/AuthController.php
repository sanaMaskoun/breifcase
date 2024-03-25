<?php

namespace App\Http\Controllers;

use App\Enums\RolesEnum;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $roleValue = intval($request->role);
        $role = RolesEnum::getKey($roleValue);
        $request->validate([
            'name'                  => ['required', 'string'],
            'email'                 => ['required', 'string', 'unique:users'],
            'password'              => ['required', 'string', 'confirmed'],
            'password_confirmation' => ['required', 'same:password'],
            'phone'                 => ['required', 'numeric', 'digits_between:7,14'],
            'role'                  => ['required', Rule::in([RolesEnum::client, RolesEnum::Lawyer, RolesEnum::legalConsultant, RolesEnum::typingCenter])]
        ]);
        $user = new User([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
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


            return response()->json([
                'message' => 'Successfully created user!',
                'accessToken' => $token,
                'user' => $user
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
            'password.min'      => trans('validation.minPassword'),
            'password.max'      => trans('validation.maxPassword'),
            'email.required'    => trans('validation.requiredEmail'),
            'email.email'       => trans('validation.email'),
        ]);
    }


    public function username()
    {
        return 'email';
    }


    protected function sendLoginResponse(Request $request, $user, $token)
    {
       

        return new JsonResponse([
            'id'           => $user->id,
            'name'         => $user->name,
            'email'        => $user->email,
            'phone'        => $user->phone,
            'gender'       => $user->gender,
            'location'     => $user->location,
            'birth'        => $user->birth,
            'is_active'    => $user->is_active,
            'access_token' => $token,
            'image'        => $user->getFirstMediaUrl('profileUser'),

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
            'message' => 'Successfully logged out'
        ]);
    }
}

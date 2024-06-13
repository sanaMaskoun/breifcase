<?php

namespace App\Http\Controllers\api;

use App\Enums\CountryEnum;
use App\Enums\SaudiCityEnum;
use App\Enums\UAECityEnum;
use App\Enums\UserTypeEnum;
use App\Events\NotificationEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\PracticeResource;
use App\Http\Resources\UserResource;
use App\Models\Practice;
use App\Models\User;
use App\Notifications\RequestToJoin;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Pusher\Pusher;
use Pusher\PusherException;

class AuthApiController extends Controller
{
    public function pusherAuth(Request $request)
    {
        try {
            $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'));
        } catch (PusherException $e) {
        }
        // if($request->request->get('channel_name') === 'private-chat') {
        return $pusher->socket_auth($request->request->get('channel_name'), $request->request->get('socket_id'));
        // }
        return response()->json([], 400);

    }

    public function getPusherConfig(Request $request)
    {
        $pusherOptions = [
            // 'host' => 'example.com',
            'wsPort' => 6001,

            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true,

            'encrypted' => false,
            'auth' => [
                'endpoint' => url('/api/pusher/auth'),
                'headers' => [
                    'Authorization' => 'Bearer ' . $request->user()->currentAccessToken()->token,
                ],
            ],
        ];

        $pusherConfig = [
            'appKey' => env('PUSHER_APP_KEY'),
            'options' => $pusherOptions,
            'autoConnect' => false,
        ];

        return response()->json($pusherConfig);
    }

    public function register(Request $request)
    {
        $personal_rules = [
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['required', 'numeric', 'digits_between:7,14'],
            'password' => ['required', 'string', 'confirmed'],
            'password_confirmation' => ['required', 'same:password'],
            'gender' => ['required'],
            'birth' => ['required'],
            'country' => ['required', Rule::in(CountryEnum::getValues())],
            'city' => ['required'],
            'emirates_id' => ['required', 'numeric'],
            'front_emirates_id' => ['required'],
            'back_emirates_id' => ['required'],
            'profile'  => ['nullable']

        ];

        if ($request->country === CountryEnum::Saudi) {
            $personal_rules['city'] = ['required', Rule::in(SaudiCityEnum::getValues())];
        } elseif ($request->country === CountryEnum::UAE) {
            $personal_rules['city'] = ['required', Rule::in(UAECityEnum::getValues())];
        }

        $request->validate(array_merge($personal_rules, $this->getUserSpecificRules($request)));

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'type' => $request->type,
            'password' => bcrypt($request->password),
            'gender' => $request->gender,
            'birth' => $request->birth,
            'country' => $request->country,
            'city' => $request->city,
            'emirates_id' => $request->emirates_id,
        ]);

        $user->save();

        $user->addMedia($request->front_emirates_id)
            ->toMediaCollection('front_emirates_id');

        $user->addMedia($request->back_emirates_id)
            ->toMediaCollection('back_emirates_id');

        $this->createUserSpecificData($user, $request);


        $admins = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();

        $joined_user = $request->name;
        $email = $request->email;
        $encodedUserId = base64_encode($user->id);

        Notification::send($admins, new RequestToJoin($user->id, $joined_user, $email));
        $data = [
            'user_id' => $user->id,
            'user_name' => $request->name,
            'email' => $request->email,
            'profile_image' => $user->getFirstMediaUrl('profile'),

        ];
        event(new NotificationEvent($data, $encodedUserId));

            if ($user->type == UserTypeEnum::client) {
                $user->load('client');
            } elseif ($user->type ==  UserTypeEnum::lawyer ||  $user->type ==  UserTypeEnum::translation_company) {
                $user->load(['lawyer','practices','languages']);
            }
            return response()->json([
                'accessToken' => $user->createToken('Personal Access Token')->plainTextToken,
                'user' => new UserResource($user),
            ], 201);

    }

    private function getUserSpecificRules(Request $request)
    {
        $type_value = intval($request->type);
        $type = UserTypeEnum::getKey($type_value);

        $specific_rules = [];

        if ($type == "client")
         {
            $specific_rules = ['occupation' => 'required|string|max:255'];

        }
        elseif ($type == "lawyer" ||$type == "translation_company") {
            $specific_rules = [
                'land_line' => ['required', 'numeric'],
                'consultation_price' => ['required', 'numeric'],
                'location' => ['required'],
                'bio' => ['required', 'max:250'],
                'years_of_practice' => ['required', 'numeric'],
                'available' => ['nullable'],
                'certifications' => ['required', 'array'],
                'licenses' => ['required', 'array'],
                'practices' => ['required', 'array' , 'exists:practices,id'],
                'languages' => ['required', 'array' , 'exists:languages,id'],
            ];
        }

        return $specific_rules;
    }

    private function createUserSpecificData(User $user, Request $request)
    {
        $type_value = intval($request->type);
        $type = UserTypeEnum::getKey($type_value);

        $user->assignRole($type);

        if($request->profile != null)
        {
            $user->addMedia($request->profile)->toMediaCollection('profile');
        }

        if ($type == "client") {

            $user->client()->create(['occupation' => $request->occupation]);
            $user->update(['is_active' => true]);


        }
         elseif ($type == "lawyer" || $type == "translation_company")
         {
            $user->lawyer()->create([
                'land_line' => $request->land_line,
                'consultation_price' => $request->consultation_price,
                'location' => $request->location,
                'bio' => $request->bio,
                'years_of_practice' => $request->years_of_practice,
                'available' => $request->available ?? false,
            ]);

            $user->practices()->sync($request->practices);
            $user->languages()->sync($request->languages);

            foreach ($request->certifications as $certification) {
                $user->lawyer->addMedia($certification)->toMediaCollection('certification');
            }
            foreach ($request->licenses as $license) {
                $user->lawyer->addMedia($license)->toMediaCollection('license');
            }


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
        if ($user->type == UserTypeEnum::client) {
            $user->load('client');
        } elseif ($user->type ==  UserTypeEnum::lawyer) {
            $user->load('lawyer');
        }
        return new JsonResponse([
            'access_token' => $token,
            'user' => new UserResource($user)
            // ->load(['consultations', 'unreadNotifications', 'GeneralQuestions', 'QuestionsReplies', 'practices', 'groups'])),

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

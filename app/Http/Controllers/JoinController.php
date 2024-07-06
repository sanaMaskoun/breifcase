<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\LawyerRequest;
use App\Models\Language;
use App\Models\Practice;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class JoinController extends Controller
{
    public function join_lawyer()

    {
        $practices = Practice::all();
        $languages = Language::all();
        return view('pages.lawyer.auth.join' , compact('practices' ,'languages'));

    }
    public function store_join_lawyer(LawyerRequest $request)
    {
        $user = User::create($request->userValidated());
        $user->lawyer()->create($request->lawyerValidated());

        $user->languages()->sync($request->languages);
        $user->practices()->sync($request->practices);

        if (!empty($request->file('profile'))) {
            $user->addMedia($request->file('profile'))->toMediaCollection('profile');
        }

        $user->addMedia($request->file('front_emirates_id'))->toMediaCollection('front_emirates_id');

        $user->addMedia($request->file('back_emirates_id'))->toMediaCollection('back_emirates_id');

        foreach ($request->file('certifications') as $certification) {
            $user->lawyer->addMedia($certification)->toMediaCollection('certification');
        }
        foreach ($request->file('licenses') as $license) {
            $user->lawyer->addMedia($license)->toMediaCollection('license');
        }


        return view('pages.welcome');
    }
    public function join_client()
    {

        return view('pages.client.auth.join');
    }
    public function store_join_client(ClientRequest $request)
    {
        $user = User::create($request->userValidated());
        $user->client()->create($request->clientValidated());

        if (!empty($request->file('profile'))) {
            $user->addMedia($request->file('profile'))->toMediaCollection('profile');
        }
        $user->addMedia($request->file('front_emirates_id'))->toMediaCollection('front_emirates_id');

        $user->addMedia($request->file('back_emirates_id'))->toMediaCollection('back_emirates_id');
        $user->assingRole('client');

        Auth::login($user);

        return redirect()->route('home');
    }

    public function join_translation_company()
    {
        $languages = Language::all();

        return view('pages.company.auth.join' ,compact('languages'));

    }
    public function store_join_translation_company(CompanyRequest $request)
    {
        $user = User::create($request->userValidated());
        $user->lawyer()->create($request->companyValidated());

        $user->languages()->sync($request->languages);

        if (!empty($request->file('profile'))) {
            $user->addMedia($request->file('profile'))->toMediaCollection('profile');
        }



        foreach ($request->file('certifications') as $certification) {
            $user->lawyer->addMedia($certification)->toMediaCollection('certification');
        }
        foreach ($request->file('licenses') as $license) {
            $user->lawyer->addMedia($license)->toMediaCollection('license');
        }


        return view('pages.welcome');
    }
}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyApiController extends Controller
{
    public function update(CompanyUpdateRequest $request, User $user)
    {
        if (Auth()->user()->is_active == 0) {
            return response()->json(['error' => 'This account is inactive']);
        }

        $user->update($request->userValidated());
        $user->lawyer()->update($request->companyValidated());

        $user->languages()->sync($request->languages);

        if (empty($request->profile)) {
            $user->clearMediaCollection('profile');
        }
        if (!empty($request->profile)) {
            $user->addMedia($request->profile)->toMediaCollection('profile');
        }


        $certifications = $request->certifications;
        $licenses = $request->licenses;

        foreach ($certifications as $certification) {
            $user->lawyer->clearMediaCollection('certification');

            $user->lawyer->addMedia($certification)->toMediaCollection('certification');
        }

        foreach ($licenses as $license) {
            $user->lawyer->clearMediaCollection('license');

            $user->lawyer->addMedia($license)->toMediaCollection('license');
        }

        return response()->json(new UserResource($user->load(['lawyer', 'languages'])));
    }
}

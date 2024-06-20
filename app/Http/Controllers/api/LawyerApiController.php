<?php

namespace App\Http\Controllers\api;

use App\Enums\UserTypeEnum;
use App\Filters\CityFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\LawyerRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class LawyerApiController extends Controller
{
    public function index()
    {
        $users = QueryBuilder::for(User::class)
            ->with('practices', 'languages')
            ->allowedFilters([
                'name',
                AllowedFilter::custom('city', new CityFilter()),
                AllowedFilter::partial('practice', 'practices.name'),
                AllowedFilter::partial('language', 'languages.name'),
            ])
            ->where('is_active', true)
            ->get();
        $lawyers = $users->where('type', UserTypeEnum::lawyer);
        $translation_company = $users->where('type', UserTypeEnum::translation_company);

        return response()->json([
            'lawyers' => UserResource::collection($lawyers),
            'translationCompany' => UserResource::collection($translation_company),
        ]);
    }

    public function show(User $user)
    {
        $average_rate = DB::table('rates')
            ->where('lawyer_id', $user->id)
            ->select(DB::raw('(AVG(understanding) + AVG(problem_solving) + AVG(response_time) + AVG(communication)) / 4 as average_rate'))
            ->value('average_rate');

        return response()->json([
            'user' => new UserResource($user->load(['lawyer', 'practices','consultations_receiver' , 'cases_receiver' , 'invoice_receiver','questions_replies.user' , 'questions_replies.general_question'])),
            'rate' => number_format($average_rate, 1),
        ]);
    }

    public function update(LawyerRequest $request, User $user)
    {
        if (Auth()->user()->is_active == 0) {
            return response()->json(['error' => 'This account is inactive']);
        }

        $user->update($request->userValidated());
        $user->lawyer()->update($request->lawyerValidated());

        $user->practices()->sync($request->practices);
        $user->languages()->sync($request->languages);

        if (empty($request->profile)) {
            $user->clearMediaCollection('profile');
        }
        if (!empty($request->profile)) {
            $user->addMedia($request->profile)->toMediaCollection('profile');
        }

        $user->clearMediaCollection('front_emirates_id');
        $user->addMedia($request->front_emirates_id)->toMediaCollection('front_emirates_id');

        $user->clearMediaCollection('back_emirates_id');
        $user->addMedia($request->back_emirates_id)->toMediaCollection('back_emirates_id');


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

        return response()->json(new UserResource($user->load(['lawyer', 'languages', 'practices'])));
    }
}

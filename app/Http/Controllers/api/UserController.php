<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{

    public function index()
    {
        $users = QueryBuilder::for(User::class)
            ->with('practices')
            ->AllowedFilters([
                'name', 'location',
                AllowedFilter::partial('practice', 'practices.name'),
            ])
            ->where('is_active', true)
            ->get();
        $legalConsultant = $this->getUsersByRole($users, 'legalConsultant');
        $lawyers = $this->getUsersByRole($users, 'lawyer');
        $typingCenter = $this->getUsersByRole($users, 'typingCenter');

        return response()->json([
            'lawyers' => UserResource::collection($lawyers),
            'legalConsultant' => UserResource::collection($legalConsultant),
            'typingCenter' => UserResource::collection($typingCenter),
        ]);
    }

    private function getUsersByRole($users, $role)
    {
        return $users->filter(function ($user) use ($role) {
            return $user->roles->contains('name', $role);
        });
    }


    public function show(User $user)
    {
        $averageRate = DB::table('rates')
            ->where('employee_id', $user->id)
            ->select(DB::raw('(AVG(understanding) + AVG(problem_solving) + AVG(response_time) + AVG(communication)) / 4 as average_rate'))
            ->value('average_rate');
        return response()->json([
            'user' => new UserResource($user->load(['consultations', 'GeneralQuestions', 'QuestionsReplies', 'practices'])),
            'rate' => number_format($averageRate, 1)
        ]);
    }

    public function update(UserRequest $request, User $user)
    {
        if (Auth()->user()->is_active == 0) {
            return response()->json(['error' => 'This account is inactive']);
        }
        $user->update($request->validated());

        $user->clearMediaCollection('profileUser');
        $user->addMedia($request->file('profileUser'))->toMediaCollection('profileUser');

        $certifications = $request->file('certification');

        foreach ($certifications as $certification) {
            $user->addMedia($certification)
                ->withCustomProperties(['do_not_replace' => true])
                ->toMediaCollection('certification');
        }

        return response()->json(
            new UserResource($user),
        );
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\LawyerRequest;
use App\Models\Practice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class LawyerController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->query('name');
        $location = $request->query('location');
        $practice = $request->query('practice');

        $practices = Practice::all();

        $lawyers = QueryBuilder::for(User::class)
            ->with('practices')
            ->allowedFilters([
                'name', 'location',
                AllowedFilter::partial('name', 'practices.id'),
            ])
            ->where('name', 'like', '%' . $name . '%')
            ->when($location, function ($query) use ($location) {
                return $query->where('location', $location);
            })
            ->when($practice, function ($query) use ($practice) {
                return $query->whereHas('practices', function ($query) use ($practice) {
                    $query->where('practices.id', $practice);
                });
            })
            ->where('is_active', true)
            ->whereHas('roles', function ($query) {
                $query->whereIn('name', ['lawyer', 'legalConsultant', 'typingCenter']);
            })
            ->paginate(config('constants.PAGINATION_COUNT'));

        return view('pages.lawyer.list', compact(['lawyers', 'practices']));
    }

    public function show($encodedId)
    {
        $decodedId = base64_decode($encodedId);
        $lawyer = User::find($decodedId);
        $practices = $lawyer?->practices;
        $NumReplies = $lawyer->replies->count();
        $NumConsultations = $lawyer->consultations->count();

        $get_notify = DB::table('notifications')->where('data->user_id', $lawyer->id)->where('notifiable_id', Auth()->user()->id)->first();
        if ($get_notify != null) {DB::table('notifications')->where('id', $get_notify->id)->update(['read_at' => now()]);}

        return view('pages.lawyer.details', compact(['lawyer', 'practices', 'NumReplies', 'NumConsultations']));
    }

    public function edit($encodedId)
    {
        $practices = Practice::all();
        $decodedId = base64_decode($encodedId);
        $lawyer = User::find($decodedId);

        $NumReplies = $lawyer->replies->count();
        $NumConsultations = $lawyer->consultations->count();

        return view('pages.lawyer.edit', compact(['lawyer', 'practices','NumReplies', 'NumConsultations']));
    }
    public function update(LawyerRequest $request, User $lawyer)
    {
        $lawyer->update($request->validated());
        $lawyer->practices()->sync($request->practices);
        if (!is_null(request()->file('profileUser'))) {
            $lawyer->clearMediaCollection('profileUser');
            $lawyer->addMedia($request->file('profileUser'))->toMediaCollection('profileUser');

        }
        if (!is_null(request()->file('certification'))) {
            $certifications = request()->file('certification');

            foreach ($certifications as $certification) {
                $lawyer->addMedia($certification)
                    ->withCustomProperties(['do_not_replace' => true])
                    ->toMediaCollection('certification');
            }
        }
        $encodedId = base64_encode($lawyer->id);

        return redirect()->route('show_lawyer', $encodedId)->with('success', __('message.edit'));

    }

    public function toggleStatus(Request $request, User $lawyer)
    {

        $lawyer->is_active = !$lawyer->is_active;
        $lawyer->save();

        return redirect()->back()->with('success', __('message.status'));

    }

    public function clear_all()
    {
        foreach (Auth()->user()->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
        return redirect()->back();
    }
}

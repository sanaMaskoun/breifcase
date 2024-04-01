<?php

namespace App\Http\Controllers;

use App\Enums\RolesEnum;
use App\Http\Requests\LawyerRequest;
use App\Http\Requests\StoreLawyerRequest;
use App\Models\Practice;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\Permission\Models\Role;

class LawyerController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->query('name');
        $location = $request->query('location');
        $practice = $request->query('practice');

        $practices=Practice::all();

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
        ->get();

        return view('pages.lawyer.list', compact(['lawyers','practices']));
    }

    public function show(User $lawyer)
    {
        $practices = $lawyer->practices;
       
        return view('pages.lawyer.details' , compact('lawyer','practices'));
    }

    // public function create()
    // {
    //            return view('pages.lawyer.create');
    // }

    // public function store(StoreLawyerRequest $request)
    // {
    //     $lawyer =  User::create($request->validated());

    //     return  redirect()->route('list_lawyers')
    //         ->with('success', 'Added successfully');
    // }

    public function edit(User $lawyer)
    {
        $practices=Practice::all();
          return view('pages.lawyer.edit' ,compact(['lawyer','practices']));
    }
    public function update(LawyerRequest $request , User $lawyer)
    {
        $lawyer->update($request->validated());
        $lawyer->practices()->sync($request->practices);
        if (!is_null(request()->file('profileUser'))) {
            $lawyer->clearMediaCollection('profileUser');
            $lawyer->addMedia($request->file('profileUser'))->toMediaCollection('profileUser');
           
        }
        $certifications = request()->file('certification');
        foreach ($certifications as $certification) {
            $lawyer->addMedia($certification)
                ->withCustomProperties(['do_not_replace' => true])
                ->toMediaCollection('certification');
        }
        return redirect()->route('show_lawyer', $lawyer->id)->with('success', 'Modified successfully.');


    }
    public function destroy(User $lawyer)
    {

    }

    public function toggleStatus(Request $request, User $lawyer)
    {
        
            $lawyer->is_active = !$lawyer->is_active;
            $lawyer->save();

            return redirect()->back()->with('success', 'The active status has been updated.');
       
    }
}

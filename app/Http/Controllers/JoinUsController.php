<?php

namespace App\Http\Controllers;

use App\Models\Practice;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class JoinUsController extends Controller
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
        ->where('is_active', false)
        ->whereHas('roles', function ($query) {
            $query->whereIn('name', ['lawyer', 'legalConsultant', 'typingCenter']);
        })
        ->paginate(PAGINATION_COUNT);

        return view('pages.lawyer.list', compact(['lawyers','practices']));
    }
}

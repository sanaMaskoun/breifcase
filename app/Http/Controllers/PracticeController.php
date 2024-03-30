<?php

namespace App\Http\Controllers;

use App\Http\Requests\PracticeRequest;
use Illuminate\Http\Request;
use App\Models\Practice;
use Spatie\QueryBuilder\QueryBuilder;

class PracticeController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->query('name');
    
        $practices = Practice::query();
    
        if ($name) {
            $practices->where('name', 'like', '%' . $name . '%');
        }
    
        $practices = $practices->get();
    
        return view('pages.practices.list', compact('practices'));
    }
    

    public function create()
    {
           return view('pages.practices.create');
    }


    public function store(PracticeRequest $request)
    {
         Practice::create($request->validated());
         return redirect()->route('list_practieces')->with('success','Added successfully');

       
    }


    public function edit(Practice $practice)
    {

        return view('pages.practices.edit', compact('practice'));
    }
    public function update(PracticeRequest $request , Practice $practice)
    {
        $practice->update($request->validated());
          
        return  redirect()->route('list_practieces')
            ->with('success', 'Modified successfully');
    }
    public function destroy(Practice $practice)
    {
        $practice->delete();
          
        return  redirect()->route('list_practieces')
            ->with('success', 'delete successfully');
    }
}

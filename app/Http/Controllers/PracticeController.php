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

        $practices = $practices->paginate(PAGINATION_COUNT);

        return view('pages.practices.list', compact('practices'));
    }


    public function create()
    {
           return view('pages.practices.create');
    }


    public function store(PracticeRequest $request)
    {
         Practice::create($request->validated());
         return redirect()->route('list_practieces')->with('success', __('message.success'));


    }


    public function edit($encodedId)
    {
        $decodedId = base64_decode($encodedId);
        $practice = Practice::find($decodedId);
        return view('pages.practices.edit', compact(['practice','decodedId']));
    }
    public function update(PracticeRequest $request ,  Practice $practice)
    {
        $practice->update($request->validated());

        return  redirect()->route('list_practieces')
            ->with('success', __('message.edit'));
    }
    public function destroy(Practice $practice)
    {
        $practice->delete();

        return  redirect()->route('list_practieces')
            ->with('success', __('message.delete'));
    }
}

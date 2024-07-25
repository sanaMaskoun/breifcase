<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Lang;
use App\Http\Requests\LanguageRequest;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index(Request $request)
    {

        $languages = Language::query();


        $languages = $languages->paginate(config('constants.PAGINATION_COUNT'));
        $num_languages = Language::count();

        return view('pages.lang.list', compact(['languages','num_languages']));
    }


    public function create()
    {
           return view('pages.lang.create');
    }


    public function store(LanguageRequest $request)
    {
         Language::create($request->validated());
         return redirect()->route('list_languages');


    }


    public function edit($encodedId)
    {
        $decodedId = base64_decode($encodedId);
        $language = Language::find($decodedId);
        return view('pages.languages.edit', compact(['language','decodedId']));
    }
    public function update(LanguageRequest $request ,  Language $language)
    {
        $language->update($request->validated());

        return  redirect()->route('list_languages')
            ->with('success', __('message.edit'));
    }
    public function destroy(language $language)
    {
        $language->delete();

        return  redirect()->route('list_languages')
            ->with('success', __('message.delete'));
    }
}

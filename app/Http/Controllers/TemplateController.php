<?php

namespace App\Http\Controllers;

use App\Http\Requests\TemplateRequest;
use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function index()
    {
        $templates =Template::all();
        return view('pages.template.list' ,compact('templates'));
    }


    public function store(TemplateRequest $request)
    {

        $template =Template::create($request->validated());
        $template->addMediaFromRequest('template')->toMediaCollection('template');
        return redirect()->back();
    }


    public function destroy(Template $template)
    {
         $template->clearMediaCollection('template');
        $template->delete();

        return  redirect()->back();
    }
}

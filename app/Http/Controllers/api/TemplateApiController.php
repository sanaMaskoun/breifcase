<?php

namespace App\Http\Controllers\Api;

use App\Enums\UserTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\TemplateResource;
use App\Models\Template;
use Illuminate\Http\Request;

class TemplateApiController extends Controller
{
    public function index()
    {
        $templates = Template::all();
        return response()->json(TemplateResource::collection($templates->load('user')));

    }


    public function store(Request $request)
    {
        if (Auth()->user()->type == UserTypeEnum::client)
        {
            return response()->json(['message' => 'You do not have permission to add a template']);
        }
        else{
            $template = Template::create(['user_id' => Auth()->user()->id]);
            $template->addMedia($request->template)->toMediaCollection('template');
            return response()->json(new TemplateResource($template->load('user')));
        }
    }
}

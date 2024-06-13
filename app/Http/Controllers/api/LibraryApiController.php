<?php

namespace App\Http\Controllers\Api;

use App\Enums\UserTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\LibraryResource;
use App\Models\Library;
use Illuminate\Http\Request;

class LibraryApiController extends Controller
{
    public function index()
    {
        $libraries = Library::all();
        return response()->json(LibraryResource::collection($libraries->load('user')));

    }

    public function store(Request $request)
    {
        if (Auth()->user()->type != UserTypeEnum::admin) {
            return response()->json(['message' => 'You do not have permission to add a books']);
        } else {
            $rules = [
                'title' => ['required', 'max:50'],
                'library' => ['required'],

            ];
            $request->validate($rules);

            $library = Library::create(['user_id' => Auth()->user()->id,
                                        'title' => $request->title
                                       ]);

            $library->addMedia($request->library)->toMediaCollection('library');
            
            return response()->json(new LibraryResource($library->load('user')));
        }
    }
}

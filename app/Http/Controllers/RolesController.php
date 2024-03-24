<?php

namespace App\Http\Controllers;

use App\Enums\RolesEnum;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index()
    {

        $values = array_keys(RolesEnum::toSelectArray());

        return response()->json($values);
        // return response()->json(RolesEnum::toSelectArray());

       
        // $roles = [];

        // foreach (RolesEnum::toSelectArray() as $key => $value) {
        //     $roles[] = [
        //         'value' => $key,
        //         'key' => $value,
        //     ];
        // }

        // return response()->json($roles);
    }
}

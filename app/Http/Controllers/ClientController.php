<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->query('name');

        $clients = User::where('name', 'like', '%' . $name . '%')
        ->whereHas('roles', function ($query) {
            $query->where('name','client');
        })
        ->get();

        return view('pages.client.list', compact('clients'));
    }
    public function show(User $client)
    {
        $NumConsultation = $client->consultations->count();
        $NumGeneralQuestion =$client->GeneralQuestions->count();

         return view('pages.client.details',compact(['client','NumGeneralQuestion','NumConsultation']));
    }

}

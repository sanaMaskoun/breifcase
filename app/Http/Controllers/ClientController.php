<?php

namespace App\Http\Controllers;

use App\Enums\UserTypeEnum;
use App\Http\Requests\ClientUpdateRequest;
use Illuminate\Http\Request;
use App\Models\User;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $clients = User::where('type', UserTypeEnum::client)
            ->where('is_active', true)
            ->paginate(config('constants.PAGINATION_COUNT'));

        return view('pages.client.list', compact('clients'));
    }
    public function show($client_encoded_id)
    {
        $client_decoded_id = base64_decode($client_encoded_id);
        $client = User::find($client_decoded_id);

         return view('pages.client.show',compact('client'));
    }

    public function details($client_encoded_id)
    {
        $client_decoded_id = base64_decode($client_encoded_id);
        $client = User::find($client_decoded_id);
        return view('pages.client.details', compact('client'));
    }

    public function edit($client_encoded_id)
    {
        $client_decoded_id = base64_decode($client_encoded_id);
        $client = User::find($client_decoded_id);

        return view('pages.client.edit' , compact('client'));
    }

    public function update(ClientUpdateRequest $request, User $client)
    {
        $client->update($request->validated());
        if (!is_null(request()->file('profile'))) {
            $client->clearMediaCollection('profileUser');
            $client->addMedia($request->file('profileUser'))->toMediaCollection('profileUser');

        }

        $client_encoded_id = base64_encode($client->id);

        return redirect()->route('show_client', $client_encoded_id);

    }
}

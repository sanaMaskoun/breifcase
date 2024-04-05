<?php

namespace App\Http\Controllers;

use App\Enums\RolesEnum;
use Illuminate\Http\Request;
use App\Models\Consultation;
use App\Models\User;

class ConsultationController extends Controller
{
    public function index(Request $request)
    {
        $user_id=$request->user;

        if($user_id)
        {
            $user = User::find($user_id);
            $role = $user->roles()->first()->name;

            $role == 'client' ? $consultations = Consultation::where('sender_id' , $user_id)->get() :$consultations = Consultation::where('receiver_id' , $user_id)->get();

        }

        else
        {
            $consultations = Consultation::all();
        }

        return view('pages.consultation.list',compact('consultations'));
    }
    public function show(Consultation $consultation)
    {
        return view('pages.consultation.details',compact('consultation'));
    }
}

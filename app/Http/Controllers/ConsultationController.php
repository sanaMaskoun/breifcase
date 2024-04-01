<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultation;


class ConsultationController extends Controller
{
    public function index()
    {
        $consultations = Consultation::all();
        return view('pages.consultation.list',compact('consultations'));
    }
    public function show(Consultation $consultation)
    {
        return view('pages.consultation.details',compact('consultation'));
    }
}

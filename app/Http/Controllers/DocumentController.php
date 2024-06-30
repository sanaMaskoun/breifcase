<?php

namespace App\Http\Controllers;

use App\Enums\DocumentTypeEnum;
use App\Http\Requests\ConsultationRequest;
use App\Models\Document;
use App\Models\User;

class DocumentController extends Controller
{
    public function index()
    {
        $client = Auth()->user();
        $consultations = Document::where('sender_id', Auth()->user()->id)->where('type', DocumentTypeEnum::consultation)->get();
        $cases = Document::where('sender_id', Auth()->user()->id)->where('type', DocumentTypeEnum::case )->get();
        return view('pages.document.list', compact('client', 'consultations', 'cases'));
    }
    public function index_consultations($receiver_encoded_id = null)
    {
        if($receiver_encoded_id <> null)
        {
            $receiver_decoded_id = base64_decode($receiver_encoded_id);
            $lawyer = User::find($receiver_decoded_id);

            $consultations = Document::where('receiver_id', $lawyer->id)->where('type', DocumentTypeEnum::consultation)->get();
            $num_consultations =Document::where('receiver_id', $lawyer->id)->where('type', DocumentTypeEnum::consultation)->count();
        }
        else {
            $consultations = Document::where('type', DocumentTypeEnum::consultation)->get();
            $num_consultations =Document::where('type', DocumentTypeEnum::consultation)->count();


        }
        return view('pages.document.listConsultations', compact('consultations' ,'num_consultations'));
    }
    public function index_cases($receiver_encoded_id = null)
    {
        if($receiver_encoded_id <> null)
        {
            $receiver_decoded_id = base64_decode($receiver_encoded_id);
            $lawyer = User::find($receiver_decoded_id);

            $cases = Document::where('receiver_id', $lawyer->id)->where('type', DocumentTypeEnum::case)->get();
            $num_cases =Document::where('receiver_id', $lawyer->id)->where('type', DocumentTypeEnum::case)->count();
        }
        else {
            $cases = Document::where('type', DocumentTypeEnum::case)->get();
            $num_cases =Document::where('type', DocumentTypeEnum::case)->count();


        }
        return view('pages.document.listCases', compact('cases' ,'num_cases'));
    }

    public function create($receiver_encoded_id)
    {
        $receiver_decoded_id = base64_decode($receiver_encoded_id);

        $lawyer = User::find($receiver_decoded_id);
        return view('pages.document.create', compact('lawyer'));
    }
    public function store(ConsultationRequest $request, User $receiver)
    {
        Document::create($request->validated());

        $lawyer_encoded_id = base64_encode($receiver->id);
        return redirect()->route('show_lawyer', $lawyer_encoded_id);
    }


    public function reviews()
    {
        return view ('pages.document.reviews');
    }
}

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

    public function create($receiver_encoded_id)
    {
        $receiver_encoded_id = base64_decode($receiver_encoded_id);

        $lawyer = User::find($receiver_encoded_id);
        return view('pages.document.create', compact('lawyer'));
    }
    public function store(ConsultationRequest $request, User $receiver)
    {
        Document::create($request->validated());

        $lawyer_encoded_id = base64_encode($receiver->id);
        return redirect()->route('show_lawyer', $lawyer_encoded_id);
    }
}

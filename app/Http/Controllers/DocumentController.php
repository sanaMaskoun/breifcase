<?php

namespace App\Http\Controllers;

use App\Enums\DocumentTypeEnum;
use App\Http\Requests\ConsultationRequest;
use App\Models\Document;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
        if ($receiver_encoded_id != null) {
            $receiver_decoded_id = base64_decode($receiver_encoded_id);
            $lawyer = User::find($receiver_decoded_id);

            $consultations = Document::where('receiver_id', $lawyer->id)->where('type', DocumentTypeEnum::consultation)->get();
            $num_consultations = Document::where('receiver_id', $lawyer->id)->where('type', DocumentTypeEnum::consultation)->count();
        } else {
            $consultations = Document::where('type', DocumentTypeEnum::consultation)->get();
            $num_consultations = Document::where('type', DocumentTypeEnum::consultation)->count();

        }
        return view('pages.document.listConsultations', compact('consultations', 'num_consultations'));
    }
    public function index_cases($receiver_encoded_id = null)
    {
        if ($receiver_encoded_id != null) {
            $receiver_decoded_id = base64_decode($receiver_encoded_id);
            $lawyer = User::find($receiver_decoded_id);

            $cases = Document::where('receiver_id', $lawyer->id)->where('type', DocumentTypeEnum::case )->get();
            $num_cases = Document::where('receiver_id', $lawyer->id)->where('type', DocumentTypeEnum::case )->count();
        } else {
            $cases = Document::where('type', DocumentTypeEnum::case )->get();
            $num_cases = Document::where('type', DocumentTypeEnum::case )->count();

        }
        return view('pages.document.listCases', compact('cases', 'num_cases'));
    }


    public function index_requests($receiver_encoded_id)
    {

            $receiver_decoded_id = base64_decode($receiver_encoded_id);
            $company = User::find($receiver_decoded_id);

            $requests = Document::where('receiver_id', $company->id)->get();
            $num_requests = Document::where('receiver_id', $company->id)->count();

        return view('pages.document.listRequest', compact('requests', 'num_requests'));
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

        $rates = Rate::where('lawyer_id', auth()->user()->id)
            ->select(
                'comment', 'client_id', 'document_id',
                DB::raw('(understanding + problem_solving + response_time + communication) / 4 as average_rate')
            )
            ->get();

        return view('pages.document.reviews', compact('rates'));

    }


    public function show($consultaion_encode_id)
    {
        $consultaion_decode_id = base64_decode($consultaion_encode_id);
        $consultaion = Document::find( $consultaion_decode_id);

        return view('pages.document.consultaion.show',compact('consultaion'));
    }
}

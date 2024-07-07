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

    public function index_requests($receiver_encoded_id)
    {

            $receiver_decoded_id = base64_decode($receiver_encoded_id);
            $company = User::find($receiver_decoded_id);

            $requests = Document::where('receiver_id', $company->id)->get();
            $num_requests = Document::where('receiver_id', $company->id)->count();

        return view('pages.document.listRequest', compact('requests', 'num_requests'));
    }

}

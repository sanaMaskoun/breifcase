<?php

namespace App\Http\Controllers;

use App\Enums\DocumentStatusEnum;
use App\Enums\UserTypeEnum;
use App\Http\Requests\SendRequestToCompanyRequest;
use App\Models\Document;
use App\Models\User;
use App\Traits\MessageTrait;
use Illuminate\Support\Facades\DB;

class TranslationCompanyController extends Controller
{
    use  MessageTrait;

    public function index()
    {
        $companies = User::where('type', UserTypeEnum::translation_company)
        ->where('is_active', true)
        ->paginate(config('constants.PAGINATION_COUNT'));
       
    return view('pages.company.list', compact('companies'));
    }
    public function show($company_encoded_id)
    {
        $company_decoded_id = base64_decode($company_encoded_id);
        $company = User::find($company_decoded_id);

        $get_notify = DB::table('notifications')->where('data->user_id', $company->id)->where('notifiable_id', Auth()->user()->id)->first();
        if ($get_notify != null) {DB::table('notifications')->where('id', $get_notify->id)->update(['read_at' => now()]);}

        return view('pages.company.show', compact('company'));
    }
    public function details($company_encoded_id)
    {
        $company_decoded_id = base64_decode($company_encoded_id);
        $company = User::find($company_decoded_id);
        return view('pages.company.details', compact('company'));
    }
    public function send_request($company_encoded_id)
    {
        $receiver_encoded_id = base64_decode($company_encoded_id);

        $company = User::find($receiver_encoded_id);
        return view('pages.company.sendRequest', compact('company'));
    }
    public function store_request(SendRequestToCompanyRequest $request, $company_encoded_id)
    {
        $document = Document::create($request->validated());

        $document->addMediaFromRequest('upload_document')->toMediaCollection('translateFile');

        return redirect()->route('show_company', $company_encoded_id);
    }
    public function contact($company_encoded_id)
    {
        $company_encoded_id = base64_decode($company_encoded_id);

        $company = User::find($company_encoded_id);
        $messages = $this->get_messages($company);
        return view('pages.company.contact', compact('company', 'messages'));
    }
}

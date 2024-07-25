<?php

namespace App\Http\Controllers;

use App\Enums\DocumentStatusEnum;
use App\Enums\InvoiceStatusEnum;
use App\Enums\UserTypeEnum;
use App\Events\RequestEvent;
use App\Http\Requests\SendRequestToCompanyRequest;
use App\Http\Services\FatoorahService;
use App\Models\Document;
use App\Models\Invoice;
use App\Models\User;
use App\Notifications\RequestNotification;
use App\Traits\MessageTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class TranslationCompanyController extends Controller
{
    use  MessageTrait;

    private $fatoorahService;
    public function __construct(FatoorahService $fatoorahService)
    {

        $this->fatoorahService = $fatoorahService;

    }
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
$company = User::find(base64_decode($company_encoded_id));
        $admin=User::where('type' , UserTypeEnum::admin)->first();

        $data = [
            "CustomerName" => $admin->name,
            "Notificationoption" => "LNK",
            "Invoicevalue" => $company->lawyer->consultation_price,
            "CustomerEmail" => $admin->email,
            "CallBackUrl" => env('success_url'),
            "ErrorUrl" => env('error_url'),
            "Language" => 'en',
            "DisplayCurrencyIso" => 'KWD',
        ];

        $payment_response = $this->fatoorahService->sendPayment($data);

        Invoice::create([
            'document_id' => $document->id,
            'invoiceId' => $payment_response['Data']['InvoiceId'],
            'invoice_value' => $company->lawyer->consultation_price,
            'sender_id' => Auth()->user()->id,
            'receiver_id' => $company->id,
            'status' => InvoiceStatusEnum::pending,
        ]);
        $notificationData = [
            'client_id' => Auth()->user()->id,
            'client_name' => Auth()->user()->name,
            'document_id' => $document->id,
            'document_title' => $document->title,
        ];

        Notification::send($company, new RequestNotification($notificationData));

        event(new RequestEvent($notificationData, base64_encode($document->id) , $company->id));

        return redirect($payment_response['Data']['InvoiceURL']);
    }
    public function contact($company_encoded_id)
    {
        $company_encoded_id = base64_decode($company_encoded_id);

        $company = User::find($company_encoded_id);
        $messages = $this->get_messages($company);
        return view('pages.company.contact', compact('company', 'messages'));
    }
}

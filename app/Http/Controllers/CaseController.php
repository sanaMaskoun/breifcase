<?php

namespace App\Http\Controllers;

use App\Enums\DocumentStatusEnum;
use App\Enums\DocumentTypeEnum;
use App\Enums\InvoiceStatusEnum;
use App\Events\AcceptCaseEvent;
use App\Events\CaseEvent;
use App\Events\ClosedCaseAdminEvent;
use App\Events\ClosedCaseClientEvent;
use App\Events\RejectCaseEvent;
use App\Http\Requests\AcceptCaseRequest;
use App\Http\Requests\CaseRequest;
use App\Http\Services\FatoorahService;
use App\Models\Document;
use App\Models\Invoice;
use App\Models\Template;
use App\Models\User;
use App\Notifications\AcceptCaseNotification;
use App\Notifications\CaseNotification;
use App\Notifications\ClosedCaseAdminNotification;
use App\Notifications\ClosedCaseClientNotification;
use App\Notifications\RejectCaseNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;

class CaseController extends Controller
{

    private $fatoorahService;
    public function __construct(FatoorahService $fatoorahService)
    {

        $this->fatoorahService = $fatoorahService;

    }
    public function index($receiver_encoded_id = null)
    {
        if ($receiver_encoded_id != null) {
            $receiver_decoded_id = base64_decode($receiver_encoded_id);
            $lawyer = User::find($receiver_decoded_id);

            $cases = Document::where('sender_id', $lawyer->id)->where('type', DocumentTypeEnum::case )->get();
            $num_cases = Document::where('sender_id', $lawyer->id)->where('type', DocumentTypeEnum::case )->count();
        } else {
            $cases = Document::where('type', DocumentTypeEnum::case )->get();
            $num_cases = Document::where('type', DocumentTypeEnum::case )->count();

        }
        $status_texts = [
            DocumentStatusEnum::pending => 'Pending',
            DocumentStatusEnum::ongoing => 'Ongoing',
            DocumentStatusEnum::closed => 'Closed',
            DocumentStatusEnum::rejected => 'Rejected',
        ];

        return view('pages.document.case.list', compact('cases', 'status_texts','num_cases'));
    }

    public function show($case_encode_id)
    {
        $case_decode_id = base64_decode($case_encode_id);
        $case = Document::find($case_decode_id);
        $status_texts = [
            DocumentStatusEnum::pending => 'Pending',
            DocumentStatusEnum::ongoing => 'Ongoing',
            DocumentStatusEnum::closed => 'Closed',
            DocumentStatusEnum::rejected => 'Rejected',
        ];
        return view('pages.document.case.show', compact('case','status_texts'));
    }

    public function details($case_encode_id)
    {
        $case_decode_id = base64_decode($case_encode_id);
        $case = Document::find($case_decode_id);

        return view('pages.document.case.details', compact('case'));
    }
    public function create($template_encode_id, $receiver_encode_id)
    {
        $template_decode_id = base64_decode($template_encode_id);
        $template = Template::find($template_decode_id);
        return view('pages.document.case.create', compact('template', 'receiver_encode_id'));
    }

    public function store(CaseRequest $request, $template_encode_id, $receiver_encode_id)
    {
        $template_decode_id = base64_decode($template_encode_id);
        $template = Template::find($template_decode_id);

        $media_items = $template->getFirstMedia('template');

        $case = Document::create($request->validated());
        $case->addMedia($media_items->getPath())->toMediaCollection('case_template');

        $notificationData = [
            'lawyer_id' => Auth()->user()->id,
            'lawyer_name' => Auth()->user()->name,
            'case_id' => $case->id,
            'case_title' => $case->title,
        ];
        $receiver = User::find($case->receiver_id);
        Notification::send($receiver, new CaseNotification($notificationData));

        event(new CaseEvent($notificationData, base64_encode($case->id), $case->receiver_id));

        return redirect()->route('lawyer_form_dashboard', $receiver_encode_id);

    }

    public function accept_case(AcceptCaseRequest $request, $case_encode_id)
    {
        $case = Document::find(base64_decode($case_encode_id));
        $data = [
            "CustomerName" => $case->sender->name,
            "Notificationoption" => "LNK",
            "Invoicevalue" => $case->price,
            "CustomerEmail" => $case->sender->email,
            "CallBackUrl" => env('success_url'),
            "ErrorUrl" => env('error_url'),
            "Language" => 'en',
            "DisplayCurrencyIso" => 'KWD',
        ];

        $payment_response = $this->fatoorahService->sendPayment($data);

        Invoice::create([
            'document_id' => $case->id,
            'invoiceId' => $payment_response['Data']['InvoiceId'],
            'invoice_value' => $case->price,
            'sender_id' => Auth()->user()->id,
            'receiver_id' => $case->sender->id,
            'status' => InvoiceStatusEnum::accepte,
        ]);
        $case->addMediaFromRequest('accept_case')->toMediaCollection('accept_case');
        $case->update(['accept_case' => true,
            'status' => DocumentStatusEnum::ongoing,
        ]);

        $notificationData = [
            'client_name' => Auth()->user()->name,
            'case_id' => $case->id,
            'case_title' => $case->title,
        ];

        $lawyer = User::find($case->sender_id);

        Notification::send($lawyer, new AcceptCaseNotification($notificationData));

        event(new AcceptCaseEvent($notificationData, base64_encode($case->id) ,$case->sender_id));


        return redirect($payment_response['Data']['InvoiceURL']);
    }
    public function reject_case($case_encode_id)
    {
        $case = Document::find(base64_decode($case_encode_id));
        $case->update(['accept_case' => false,
            'status' => DocumentStatusEnum::rejected,
        ]);
        $notificationData = [
            'client_name' => Auth()->user()->name,
            'case_id' => $case->id,
            'case_title' => $case->title,
        ];

        $lawyer = User::find($case->sender_id);

        Notification::send($lawyer, new RejectCaseNotification($notificationData));

        event(new RejectCaseEvent($notificationData, base64_encode($case->id) ,$case->sender_id));


        return redirect()->back();
    }

    public function closed($case_encode_id)
    {
        $case = Document::find(base64_decode($case_encode_id));
        $case->update(['status' => DocumentStatusEnum::closed]);

        $admins = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();
        $client = User::find($case->sender->id);
        $data = [
            'case_id' => $case->id,
            'case_title' => $case->title,
            'case_encode_id' => $case_encode_id,
            'created_at' => Carbon::now()->format('j M Y'),

        ];

        Notification::send($admins, new ClosedCaseAdminNotification($data));
        Notification::send($client, new ClosedCaseClientNotification($data));

        event(new ClosedCaseAdminEvent($data));
        event(new ClosedCaseClientEvent($data, $client->id));
        return redirect()->back();

    }
}

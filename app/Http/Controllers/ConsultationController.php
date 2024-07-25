<?php

namespace App\Http\Controllers;

use App\Enums\DocumentStatusEnum;
use App\Enums\DocumentTypeEnum;
use App\Enums\InvoiceStatusEnum;
use App\Enums\UserTypeEnum;
use App\Events\ClosedConsultationAdminEvent;
use App\Events\ClosedConsultationClientEvent;
use App\Events\ConsultationEvent;
use App\Http\Requests\ConsultationAnswerRequest;
use App\Http\Requests\ConsultationRequest;
use App\Http\Services\FatoorahService;
use App\Models\Consultation;
use App\Models\Document;
use App\Models\Invoice;
use App\Models\Rate;
use App\Models\User;
use App\Notifications\ClosedConsultationAdminNotification;
use App\Notifications\ClosedConsultationClientNotification;
use App\Notifications\ConsultationNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class ConsultationController extends Controller
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

            $consultations = Document::where('receiver_id', $lawyer->id)->where('type', DocumentTypeEnum::consultation)->get();
            $num_consultations = Document::where('receiver_id', $lawyer->id)->where('type', DocumentTypeEnum::consultation)->count();
        } else {
            $consultations = Document::where('type', DocumentTypeEnum::consultation)->get();
            $num_consultations = Document::where('type', DocumentTypeEnum::consultation)->count();

        }
        $status_texts = [
            DocumentStatusEnum::pending => 'Pending',
            DocumentStatusEnum::ongoing => 'Ongoing',
            DocumentStatusEnum::closed => 'Closed',
            DocumentStatusEnum::rejected => 'Rejected',
        ];
        return view('pages.document.consultation.list', compact('consultations', 'status_texts', 'num_consultations'));
    }
    public function create($receiver_encoded_id)
    {
        $receiver_decoded_id = base64_decode($receiver_encoded_id);

        $lawyer = User::find($receiver_decoded_id);
        return view('pages.document.consultation.create', compact('lawyer'));
    }

    public function store(ConsultationRequest $request, User $receiver)
    {

        $consultation = Document::create($request->validated());
        $admin=User::where('type' , UserTypeEnum::admin)->first();

        $data = [
            "CustomerName" => $admin->name,
            "Notificationoption" => "LNK",
            "Invoicevalue" => $receiver->lawyer->consultation_price,
            "CustomerEmail" => $admin->email,
            "CallBackUrl" => env('success_url'),
            "ErrorUrl" => env('error_url'),
            "Language" => 'en',
            "DisplayCurrencyIso" => 'KWD',
        ];

        $payment_response = $this->fatoorahService->sendPayment($data);

        Invoice::create([
            'document_id' => $consultation->id,
            'invoiceId' => $payment_response['Data']['InvoiceId'],
            'invoice_value' => $receiver->lawyer->consultation_price,
            'sender_id' => Auth()->user()->id,
            'receiver_id' => $receiver->id,
            'status' => InvoiceStatusEnum::pending,
        ]);

        $notificationData = [
            'client_id' => Auth()->user()->id,
            'client_name' => Auth()->user()->name,
            'consultation_id' => $consultation->id,
            'consultation_title' => $consultation->title,
        ];

        Notification::send($receiver, new ConsultationNotification($notificationData));

        event(new ConsultationEvent($notificationData, base64_encode($consultation->id), $receiver->id));

        return redirect($payment_response['Data']['InvoiceURL']);

    }

    public function show($consultation_encode_id)
    {
        $consultation_decode_id = base64_decode($consultation_encode_id);
        $consultation = Document::find($consultation_decode_id);
        $status_texts = [
            DocumentStatusEnum::pending => 'Pending',
            DocumentStatusEnum::ongoing => 'Ongoing',
            DocumentStatusEnum::closed => 'Closed',
            DocumentStatusEnum::rejected => 'Rejected',
        ];
        return view('pages.document.consultation.show', compact('consultation', 'status_texts'));
    }
    public function reviews()
    {
        $rates = Rate::where('lawyer_id', auth()->user()->id)
            ->select(
                'comment', 'client_id', 'document_id',
                DB::raw('(understanding + problem_solving + response_time + communication) / 4 as average_rate')
            )
            ->get();

        return view('pages.document.consultation.reviews', compact('rates'));
    }

    public function reviews_list_admin()
    {
        $rates = Rate::select(
            'comment', 'client_id', 'lawyer_id', 'document_id',
            DB::raw('(understanding + problem_solving + response_time + communication) / 4 as average_rate')
        )->get();

        return view('pages.document.consultation.listReviews', compact('rates'));
    }

    public function answer(ConsultationAnswerRequest $request, $consultation_encode_id)
    {
        $consultation_decode_id = base64_decode($consultation_encode_id);
        $consultation = Document::find($consultation_decode_id);

        $get_notify = DB::table('notifications')->where('data->consultation_id', $consultation->id)->where('notifiable_id', Auth()->user()->id)->first();
        if ($get_notify != null) {DB::table('notifications')->where('id', $get_notify->id)->update(['read_at' => now()]);}

        $consultation_sent_at = $consultation->created_at;
        $timeDifference = Carbon::now()->diffInHours($consultation_sent_at);
        if ($timeDifference <= 72) {

            $consultation->update([
                'answer' => $request->answer,
                'status' => DocumentStatusEnum::ongoing,
            ]);

            $consultation->invoice()->update([
                'status' => InvoiceStatusEnum::accepte,
            ]);
            return redirect()->route('details_consultation', base64_encode($consultation->id))
                ->with('success', __('message.success_answer'));
        } else {
            return redirect()->route('details_consultation', base64_encode($consultation->id))
                ->with('error', __('message.exceeded_answer_time'));
        }
    }

    public function closed($consultation_encode_id)
    {
        $consultation = Document::find(base64_decode($consultation_encode_id));
        $consultation->update(['status' => DocumentStatusEnum::closed]);

        $admins = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();
        $client = User::find($consultation->sender->id);
        $data = [
            'consultation_id' => $consultation->id,
            'consultation_title' => $consultation->title,
            'consultation_encode_id' => $consultation_encode_id,
            'created_at' => Carbon::now()->format('j M Y'),

        ];

        Notification::send($admins, new ClosedConsultationAdminNotification($data));
        Notification::send($client, new ClosedConsultationClientNotification($data));

        event(new ClosedConsultationAdminEvent($data));
        event(new ClosedConsultationClientEvent($data, $client->id));
        return redirect()->back();

    }
}

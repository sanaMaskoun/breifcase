<?php

namespace App\Http\Controllers;

use App\Enums\DocumentStatusEnum;
use App\Enums\DocumentTypeEnum;
use App\Events\ClosedRequestAdminEvent;
use App\Events\ClosedRequestClientEvent;
use App\Http\Requests\ConsultationRequest;
use App\Models\Document;
use App\Models\Rate;
use App\Models\User;
use App\Notifications\ClosedRequestAdminNotification;
use App\Notifications\ClosedRequestClientNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

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
            $status_texts = [
                DocumentStatusEnum::pending => 'Pending',
                DocumentStatusEnum::ongoing => 'Ongoing',
                DocumentStatusEnum::closed => 'Closed',
                DocumentStatusEnum::rejected => 'Rejected',
            ];
        return view('pages.document.listRequest', compact('requests', 'num_requests' ,'status_texts'));
    }

    public function show_requests($request_encoded_id)
    {
        $request = Document::find(base64_decode($request_encoded_id));
        $status_texts = [
            DocumentStatusEnum::pending => 'Pending',
            DocumentStatusEnum::ongoing => 'Ongoing',
            DocumentStatusEnum::closed => 'Closed',
            DocumentStatusEnum::rejected => 'Rejected',
        ];
        return view('pages.document.showRequest', compact('request','status_texts'));
    }
    public function closed($request_encode_id)
    {
        $request = Document::find(base64_decode($request_encode_id));
        $request->update(['status' => DocumentStatusEnum::closed]);

        $admins = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();
        $client = User::find($request->sender->id);
        $data = [
            'request_id' => $request->id,
            'request_title' => $request->title,
            'request_encode_id' => $request_encode_id,
            'created_at' => Carbon::now()->format('j M Y'),

        ];

        Notification::send($admins, new ClosedRequestAdminNotification($data));
        Notification::send($client, new ClosedRequestClientNotification($data));

        event(new ClosedRequestAdminEvent($data));
        event(new ClosedRequestClientEvent($data, $client->id));
        return redirect()->back();

    }

}

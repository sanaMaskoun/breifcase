<?php

namespace App\Http\Controllers;

use App\Enums\DocumentTypeEnum;
use App\Events\CaseEvent;
use App\Http\Requests\CaseRequest;
use App\Models\Document;
use App\Models\Template;
use App\Models\User;
use App\Notifications\CaseNotification;
use Illuminate\Support\Facades\Notification;

class CaseController extends Controller
{
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
        return view('pages.document.case.list', compact('cases', 'num_cases'));
    }

    public function show($case_encode_id)
    {
        $case_decode_id = base64_decode($case_encode_id);
        $case = Document::find($case_decode_id);

        return view('pages.document.case.show', compact('case'));
    }
    public function create($template_encode_id ,$receiver_encode_id)
    {
        $template_decode_id = base64_decode($template_encode_id);
        $template = Template::find($template_decode_id);
        return view('pages.document.case.create', compact('template','receiver_encode_id'));
    }

    public function store(CaseRequest $request, $template_encode_id, $receiver_encode_id)
    {
        $template_decode_id = base64_decode($template_encode_id);
        $template = Template::find($template_decode_id);

        $media_items = $template->getFirstMedia('template');

        $case= Document::create($request->validated());
        $case->addMedia($media_items->getPath())->toMediaCollection('case_template');

        $notificationData = [
            'lawyer_id'       => Auth()->user()->id,
            'lawyer_name'     => Auth()->user()->name,
            'case_id'         => $case->id,
            'case_title'      => $case->title,
        ];
        $receiver = User::find($case->receiver_id);
        Notification::send($receiver, new CaseNotification($notificationData));

        event(new CaseEvent($notificationData, base64_encode($case->id), $case->receiver_id));



        return redirect()->route('lawyer_form_dashboard' ,$receiver_encode_id );


    }
}

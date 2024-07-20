<?php

namespace App\Http\Controllers;

use App\Enums\UserTypeEnum;
use App\Models\User;
use App\Traits\MessageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LawyerController extends Controller
{
    use MessageTrait;
    public function index()
    {
        $lawyers = User::where('type', UserTypeEnum::lawyer)
            ->where('is_active', true)
            ->paginate(config('constants.PAGINATION_COUNT'));

        return view('pages.lawyer.list', compact('lawyers'));
    }

    public function show($lawyer_encoded_id)
    {
        $lawyer_decoded_id = base64_decode($lawyer_encoded_id);
        $lawyer = User::find($lawyer_decoded_id);
        $practices = $lawyer?->practices;
        $languages = $lawyer?->languages;

        $get_notify = DB::table('notifications')->where('data->user_id', $lawyer->id)->where('notifiable_id', Auth()->user()->id)->first();
        if ($get_notify != null) {DB::table('notifications')->where('id', $get_notify->id)->update(['read_at' => now()]);}

        return view('pages.lawyer.show', compact(['lawyer', 'practices', 'languages']));
    }
    public function details($lawyer_encoded_id)
    {
        $lawyer_decoded_id = base64_decode($lawyer_encoded_id);
        $lawyer = User::find($lawyer_decoded_id);
        return view('pages.lawyer.details', compact('lawyer'));
    }

    public function contact($receiver_encoded_id)
    {
        $receiver_encoded_id = base64_decode($receiver_encoded_id);

        $lawyer = User::find($receiver_encoded_id);
        $messages = $this->get_messages($lawyer);
        return view('pages.lawyer.contact', compact('lawyer', 'messages'));
    }


    public function toggle_status($lawyer_encode_id)
    {

        $lawyer_decode_id = base64_decode($lawyer_encode_id);
        $lawyer = User::find( $lawyer_decode_id);
        $lawyer->is_active = !$lawyer->is_active;
        $lawyer->save();

        return redirect()->back();


    }

    public function clear_all()
    {
        foreach (Auth()->user()->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
        return redirect()->back();
    }
    // public function edit($encodedId)
    // {
    //     $practices = Practice::all();
    //     $decodedId = base64_decode($encodedId);
    //     $lawyer = User::find($decodedId);

    //     $NumReplies = $lawyer->replies->count();
    //     $NumConsultations = $lawyer->consultations->count();

    //     return view('pages.lawyer.edit', compact(['lawyer', 'practices','NumReplies', 'NumConsultations']));
    // }
    // public function update(LawyerRequest $request, User $lawyer)
    // {
    //     $lawyer->update($request->validated());
    //     $lawyer->practices()->sync($request->practices);
    //     if (!is_null(request()->file('profileUser'))) {
    //         $lawyer->clearMediaCollection('profileUser');
    //         $lawyer->addMedia($request->file('profileUser'))->toMediaCollection('profileUser');

    //     }
    //     if (!is_null(request()->file('certification'))) {
    //         $certifications = request()->file('certification');

    //         foreach ($certifications as $certification) {
    //             $lawyer->addMedia($certification)
    //                 ->withCustomProperties(['do_not_replace' => true])
    //                 ->toMediaCollection('certification');
    //         }
    //     }
    //     $encodedId = base64_encode($lawyer->id);

    //     return redirect()->route('show_lawyer', $encodedId)->with('success', __('message.edit'));

    // }




}

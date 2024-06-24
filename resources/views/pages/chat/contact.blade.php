@extends('pages.lawyer.details')
@section('form_document')
    <div class="col-lg-4 col-md-12 col-sm-12">
        <div id="chat-area" class="card" >
            <div class="profile-image"><img src="{{ $lawyer->getFirstMediaUrl('profile') }}" class="img-fluid rounded-circle img_contact" > </div>
            <div id="chat-box_1" style="scroll-behavior: smooth;"></div>


            <div id="chat-input_1">
                <input type="text" id="message-input_1" placeholder="Type a message..." />
                <button class="btn_contact" ><img src="{{ asset('assets/img/send.png') }}"  class="send_contact"></button>

                <input type="file" id="media-input" accept="image/*" />

                <button id="media-button" class="btn_send_file">
                    <img src="{{ asset('assets/img/file.png') }}" class="send_contact">
                </button>

            </div>
        </div>

    </div>
@endsection

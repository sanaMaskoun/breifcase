@extends('pages.company.details')
@section('form_document')
    <div class="col-lg-6 col-md-12 col-sm-12">
        <div id="chat-area" class="card" >
            <div id="chat-header_1"><img src="{{ $company->getFirstMediaUrl('profile') }}" class="img_contact"></div>


            <div class="card-body pb-0" style="max-height: 450px; overflow-y: auto;" id="chat_div">
                @if ($messages->isEmpty())
                    <div class="empty-messages">
                        <p>@lang('pages.empty_message')</p>
                    </div>
                @else
                    @foreach ($messages as $message)
                        @if ($message->sender_id == auth()->user()->id)
                            <!-- Media Chat Right -->
                            <div class="media media-chat media-chat-right" id="chat_area_sender">
                                <div class="media-body">
                                    <div class="text-content">
                                        @if ($message->getFirstMediaUrl('attachments') != null)
                                            @if (
                                                $message->getMedia('attachments')->first()->extension == 'jpg' ||
                                                    $message->getMedia('attachments')->first()->extension == 'png')
                                                <img class=" img_group"
                                                    src="{{ asset($message->getFirstMediaUrl('attachments')) }}">
                                                <span class="message">{{ $message->message }}</span>
                                            @else
                                                <a href="{{ $message->getFirstMediaUrl('attachments') }}" target="_blank">
                                                    <p class="message">{{ $message->message }}</p>
                                                </a>
                                            @endif
                                        @else
                                            <span class="message">{{ $message->message }}</span>
                                        @endif
                                        <time class="time">{{ $message->created_at->diffForHumans() }}</time>
                                    </div>

                                </div>
                            </div>
                        @else
                            <!-- Media Chat Left -->

                            <div class="media media-chat" id="chat_area_receiver">
                                <div class="media-body">

                                    <div class="text-content">
                                        @if ($message->getFirstMediaUrl('attachments') != null)
                                            @if (
                                                $message->getMedia('attachments')->first()->extension == 'jpg' ||
                                                    $message->getMedia('attachments')->first()->extension == 'png')
                                                <img class=" img_group"
                                                    src="{{ asset($message->getFirstMediaUrl('attachments')) }}">
                                                <span class="message">{{ $message->message }}</span>
                                            @else
                                                <a href="{{ asset($message->getFirstMediaUrl('attachments')) }}"
                                                    target="_blank">
                                                    <p class="message">{{ $message->message }}</p>
                                                </a>
                                            @endif
                                        @else
                                            <span class="message">{{ $message->message }}</span>
                                        @endif
                                        <time class="time">{{ $message->created_at->diffForHumans() }}</time>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>



            <div class="chat-footer">
                <form id="messageForm" action="{{ route('send_message_to_user', base64_encode($company->id)) }}" method="POST"
                    enctype="multipart/form-data" class="form_chat_profile">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-10 d-flex align-items-center">
                                <textarea name="message" class="form-control message-input" placeholder="@lang('pages.type_message')"></textarea>
                                <button class="btn  send-button" type="submit"><i
                                        class="fas fa-paper-plane"></i></button>
                            </div>

                            <div class="col-lg-2 d-flex justify-content-center align-items-center">
                                <label for="fileInput" class="send_file_chat">
                                    <i class="fas fa-paperclip"></i>
                                </label>
                                <input id="fileInput" type="file" name="attachments" style="display: none;">

                                <a href="{{ route('attachments', base64_encode($company->id)) }}" id="openAllAttachments"
                                    class="btn ">
                                    <i class="fas fa-folder-open"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="input-group input-group-chat">
                        <div class="input-group-append"></div>
                      </div>
                </form>

            </div>

        </div>
    </div>
@endsection

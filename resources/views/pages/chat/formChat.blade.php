@extends('pages.chat.chat')
@section('chat_form_content')
    <div class="col-lg-7 col-xxl-8">
        <!-- Chat -->
        <div class="card card-default chat-right-sidebar">
            <div class="card-header">
                @if ($role_receiver == 'client')
                    <a href="{{ route('show_client', $receiver->id) }}">
                        <h2> <img src="{{ $receiver->getFirstMediaUrl('profileUser') }}" class="rounded-circle img_list_chat"
                                alt="user_img">
                            {{ $receiver->name }}</h2>
                    </a>
                @else
                    <a href="{{ route('show_lawyer', $receiver->id) }}">
                        <h2> <img src="{{ $receiver->getFirstMediaUrl('profileUser') }}" class="rounded-circle img_list_chat"
                                alt="user_img">
                            {{ $receiver->name }}</h2>
                    </a>
                @endif
            </div>

            <div class="card-body pb-0" style="max-height: 450px; overflow-y: auto;">
                @if ($messages->isEmpty())
                <div class="empty-messages">
                    <p>There are no messages yet. Send a message to start the conversation.</p>
                </div>
                @else
                    @foreach ($messages as $message)
                        @if ($message->sender_id == auth()->user()->id)
                            <!-- Media Chat Right -->
                            <div class="media media-chat media-chat-right">
                                <div class="media-body">
                                    <div class="text-content">
                                        <span class="message">{{ $message->message }}</span>
                                        <time class="time">{{ $message->created_at->diffForHumans() }}</time>
                                    </div>
                                </div>
                            </div>


                        @else
                            <!-- Media Chat Left -->
                            <div class="media media-chat">
                                <div class="media-body">
                                    <div class="text-content">
                                        <span class="message">{{ $message->message }}</span>
                                        <time class="time">{{ $message->created_at->diffForHumans() }}</time>
                                    </div>
                                </div>
                            </div>


                        @endif
                        {{--  <br>  --}}
                    @endforeach
                @endif
            </div>

            <div class="chat-footer">
                <form action="{{ route('send_message_to_user', $receiver->id) }}" method="POST">
                    @csrf
                    <div class="input-group input-group-chat">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary" type="button" id="emoji-button">
                                <i class="fas fa-paperclip"></i>
                                </button>
                        </div>
                        <input type="text" name="message" class="form-control" aria-label="Text input with dropdown button" placeholder="Type a message...">
                        <div class="input-group-append">
                            <button class="btn btn-primary send-button" type="submit">Send</button>
                        </div>
                    </div>
                </form>
            </div>


        </div>
    </div>
@endsection

@extends('master.app')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-9">

                    <div class="blog-view">
                        <div class="blog-single-post">

                            <h3 class="blog-title">{{ $general_question->question }}
                            </h3>
                            <div class="blog-info">
                                <div class="post-list">
                                    <ul>
                                        <li>
                                            <div class="post-author">
                                                <a href="{{ route('show_client' , $general_question->user->id) }}"><img
                                                        src="{{ $general_question->user->getFirstMediaUrl('profileUser') }}" alt="Post Author"> <span>by
                                                        {{ $general_question->user->name }} </span></a>
                                            </div>
                                        </li>
                                        <li><i class="feather-clock"></i>
                                            {{ $general_question->user->created_at?->format('j M Y') }}</li>
                                        <li><i class="feather-message-square"></i> {{ count($general_question->Replies) }}
                                            Replies</li>
                                    </ul>
                                </div>
                            </div>
                        </div>






                        <div class="card author-widget clearfix">
                            <div class="card-header">
                                <h4 class="card-title">Replies ({{ count($general_question->Replies) }})</h4>
                            </div>
                            @foreach ($general_question->Replies as $reply)
                                <div class="card-body">
                                    <div class="about-author">
                                        <div class="about-author-img">
                                            <div class="author-img-wrap">
                                                <a href="{{ route('show_lawyer', $reply->user->id) }}"><img
                                                        class="img-fluid" alt=""
                                                        src="{{ $reply->user->getFirstMediaUrl('profileUser') }}"></a>
                                            </div>
                                        </div>
                                        <div class="author-details">
                                            <a href="{{ route('show_lawyer', $reply->user->id) }}"
                                                class="blog-author-name">{{ $reply->user->name }}

                                            </a>
                                            <p class="mb-0">{{ $reply->reply }}</p>
                                            <i class="feather-clock me-1"></i> {{ $reply->created_at?->format('j M Y') }}
                                        </div>
                                        <div >
                                            @if ($reply->rate != 0)
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $reply->rate)
                                                        <span class="rating-star"><i
                                                                class="fas fa-star"
                                                                style="color: rgb(242, 187, 6);"></i></span>
                                                    @else
                                                        <span class="rating-star"><i
                                                                class="far fa-star"
                                                                style="color: rgb(242, 187, 6);"></i></span>
                                                    @endif
                                                @endfor
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>







                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

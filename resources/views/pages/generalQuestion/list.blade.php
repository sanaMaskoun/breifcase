@extends('master.app')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">General Questions</h3>

                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($questions as $question)
                    <div class="col-md-6 col-xl-4 col-sm-12 d-flex">
                        <div class="blog grid-blog flex-fill">
                            <div class="blog-content">
                                <ul class="entry-meta meta-item">
                                    <li>
                                        <div class="post-author">
                                            <a href="{{ route('show_client', $question->user->id) }}">
                                                <img src="{{ $question->user->getFirstMediaUrl('profileUser') }}"
                                                    alt="Post Author">
                                                <span>
                                                    <span class="post-title">{{ $question->user->name }}</span>
                                                    <span class="post-date"><i class="far fa-clock"></i>
                                                        {{ $question->user->created_at?->format('j M Y') }}</span>
                                                </span>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <p>
                                            Num.Replies <span class="badge bg-secondary">
                                                {{ count($question->Replies) }}</span>
                                        </p>
                                    </li>
                                </ul>
                                <h3 class="blog-title"><a
                                        href="{{ route('show_general_question', $question->id) }}">{{ $question->question }}</a>
                                </h3>

                            </div>

                        </div>
                    </div>
                @endforeach



            </div>



        </div>



    </div>
@endsection

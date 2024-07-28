@extends('pages.client.show')
@section('profile_content')


<div class="container box-profile-1 ">
    <div class="row">

                <div class="col-md-6">
                    <p class="text-center title-details-question">{{ $question->title }}</p>
                    <div class=" question-section">
                        <p class="question-details-question">{{ $question->question }}</p>
                        <p class="d-flex justify-content-end">{{ $question->created_at->format('Y/m/d') }}</p>

                    </div>

                    <div class="mt-3 d-flex align-items-center">
                        <div>
                            <img src="{{ $question->user->getFirstMediaUrl('profile') }}" alt="Client"
                                class="rounded-circle img-client-question">
                        </div>

                        <div class="ml-3">
                            <p class="name-client-question">{{ $question->user->name }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mt-4 card-lawyer-question">
                    <div class="row">

                        <div class="col-12">
                            <h2 class="text-center">@lang('pages.lawyers')</h2>
                        </div>

                        @foreach ($question->replies as $reply)
                            <div class="col-4 lawyer mt-5">
                                <img class="img-lawyer-question" src="{{ $reply->user->getFirstMediaUrl('profile') }}" alt="Lawyer">
                                <p class="name-lawyer-question">{{ $reply->user->name }}</p>
                                <p>{{ $reply->reply }}</p>
                            </div>
                        @endforeach



                    </div>
                </div>

    </div>
</div>





@endsection

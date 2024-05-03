@extends('master.app')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            @if ($message = Session::get('success'))
                <div class="col-md-12">
                    <div class="alert alert-success" role="alert">
                        {{ $message }}
                    </div>
                </div>
            @endif

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">@lang('pages.client_details')</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body profile">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="about-info">
                                <h4>@lang('pages.profile')</h4>
                            </div>

                            <div class="student-profile-head">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4">
                                        <div class="profile-user-box">
                                            <div class="profile-user-img">
                                                <img src="{{ asset($client->getFirstMediaUrl('profileUser')) }}"
                                                    alt="Profile">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 d-flex align-items-center">
                                        <div class="follow-group">
                                            <div class="students-follows">
                                                <h5>@lang('pages.num_consultation')</h5>
                                                <h4>{{ $NumConsultation }}</h4>
                                            </div>
                                            <div class="students-follows">
                                                <h5>@lang('pages.num_general_questions')</h5>
                                                <h4>{{ $NumGeneralQuestion }}</h4>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="student-personals-grp">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="heading-detail">
                                            <h4>@lang('pages.personal_details')</h4>
                                        </div>

                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-user"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>@lang('pages.name')</h4>
                                                <h5>{{ $client->name }}</h5>
                                            </div>
                                        </div>

                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-phone-call"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>@lang('pages.mobile')</h4>
                                                <h5>{{ $client->phone }}</h5>
                                            </div>
                                        </div>

                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-mail"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>@lang('pages.email')</h4>
                                                <h5>{{ $client->email }}</h5>
                                            </div>
                                        </div>

                                        <div class="personal-activity mb-0">
                                            <div class="personal-icons">
                                                <i class="far fa-clock"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>@lang('pages.date_of_join')</h4>
                                                <h5>{{ $client->created_at?->format('Y-m-d') }}</h5>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="student-personals-grp">
                                <div class="card">
                                    <div class="card-body profile">
                                        <div class="heading-detail">
                                            <h4>@lang('pages.consultation')</h4>
                                        </div>
                                        @foreach ($client?->consultations->take(2) as $consultation)
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $consultation->title }}</h5>
                                                    <p class="card-text">{{ $consultation->description }}</p>
                                                    <div class="row">
                                                        <div class="col">
                                                            <span><i class="far fa-money-bill-alt"></i> @lang('pages.amount')</span>
                                                            <h6 class="mb-0">
                                                                {{ $consultation->receiver?->consultation_price }}</h6>
                                                        </div>
                                                        <div class="col">
                                                            <span><i class="far fa-calendar-alt"></i> @lang('pages.created_at')</span>
                                                            <h6 class="mb-0">
                                                                {{ $consultation->created_at?->format('Y-m-d') }}</h6>
                                                        </div>
                                                        <div class="col">
                                                            @php
                                                                $statusDescription = $consultation->status
                                                                    ? \App\Enums\ConsultationStatusEnum::getDescription(
                                                                        $consultation->status,
                                                                    )
                                                                    : 'pending';
                                                                $badgeColor =
                                                                    $consultation->status == 1
                                                                        ? 'bg-danger'
                                                                        : ($consultation->status == 2
                                                                            ? 'bg-success'
                                                                            : 'bg-primary');
                                                            @endphp
                                                            <span class="badge {{ $badgeColor }}">@lang('EnumFile.'.$statusDescription)</span>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        @php
                                            $encodedId = base64_encode($client->id);
                                        @endphp
                                        <a href="{{ route('list_consultations', $encodedId) }}"
                                            class="custom-btn btn-5">@lang('pages.view_more')</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-12">

                            <div class="card blog-comments">
                                <div class="card-header">
                                    <h4 class="card-title">@lang('pages.general_question')</h4>
                                </div>
                                <div class="card-body pb-0 profile">
                                    <ul class="comments-list">
                                        @foreach ($client?->GeneralQuestions as $generalQuestion)
                                            <li>
                                                <div class="comment">
                                                    <div class="comment-author">
                                                        <img class="avatar" alt=""
                                                            src="{{ $generalQuestion->user->getFirstMediaUrl('profileUser') }}">
                                                    </div>
                                                    <div class="comment-block">
                                                        <div class="comment-by">
                                                            <h5 class="blog-author-name">
                                                                {{ $generalQuestion->user->name }} <span class="blog-date">
                                                                    <i
                                                                        class="feather-clock me-1"></i>{{ $generalQuestion->created_at?->format('Y-m-d') }}</span>
                                                            </h5>
                                                        </div>
                                                        <p>{{ $generalQuestion->question }}</p>
                                                        <a class="comment-btn">
                                                            <i class="fa fa-reply me-2"></i> Reply
                                                        </a>
                                                    </div>
                                                </div>
                                                <ul class="comments-list reply">
                                                    @foreach ($generalQuestion?->Replies as $reply)
                                                        <li>
                                                            <div class="comment">
                                                                <div class="comment-author">
                                                                    <img class="avatar" alt=""
                                                                        src="{{ $reply->user->getFirstMediaUrl('profileUser') }}">
                                                                </div>
                                                                <div class="comment-block">
                                                                    <div class="comment-by">
                                                                        <h5 class="blog-author-name">
                                                                            {{ $reply->user->name }} <span
                                                                                class="blog-date"> <i
                                                                                    class="feather-clock me-1"></i>
                                                                                {{ $reply->created_at?->format('j M Y') }}</span>
                                                                        </h5>
                                                                    </div>
                                                                    <p>{{ $reply->reply }} </p>
                                                                    <div>
                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                            @if ($i <= $reply->rate)
                                                                                <span class="rating-star"><i
                                                                                        class="fas fa-star"
                                                                                        style="color: #9b3d00"></i></span>
                                                                            @else
                                                                                <span class="rating-star"><i
                                                                                        class="far fa-star"
                                                                                        style="color: #9b3d00"></i></span>
                                                                            @endif
                                                                        @endfor
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                    @php
                                    $encodedId =  base64_encode($client->id);

                                @endphp
                                    <a href="{{ route('list_general_questions', $encodedId) }}"
                                        class="custom-btn btn-5">@lang('pages.view_more')</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>

    </div>
@endsection

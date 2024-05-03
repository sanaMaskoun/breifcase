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
                            <h3 class="page-title">@lang('pages.lawyer_details')</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body profile">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="about-info">
                                <h4>@lang('pages.profile')
                                    @role('lawyer|typingCenter|legalConsultant')
                                        @if (Auth()->user()->id == $lawyer->id)
                                            @php
                                                $encodedId = base64_encode($lawyer->id);
                                            @endphp
                                            <div class="uplod d-flex">
                                                <form method="GET" action="{{ route('edit_lawyer', $encodedId) }}">
                                                    <label class="file-upload profile-upbtn mb-0">
                                                        <button type="submit" class="btn"> <i
                                                                class="feather-edit-3"></i></button>
                                                    </label>
                                                </form>
                                            </div>
                                        @endif
                                    @endrole
                                </h4>

                            </div>
                            <div class="student-profile-head">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4">
                                        <div class="profile-user-box">
                                            <div class="profile-user-img">
                                                <img src="{{ asset($lawyer->getFirstMediaUrl('profileUser')) }}"
                                                    alt="Profile">



                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 d-flex align-items-center">
                                        <div class="follow-group">
                                            <div class="students-follows">
                                                <h5>@lang('pages.num_consultation')</h5>
                                                <h4>{{ $NumConsultations }}</h4>
                                            </div>
                                            <div class="students-follows">
                                                <h5>@lang('pages.num_replies')</h5>
                                                <h4>{{ $NumReplies }}</h4>
                                            </div>

                                        </div>
                                    </div>
                                    @role('admin')
                                        <div class="col-lg-4 col-md-4 d-flex align-items-center">
                                            <form method="POST" action="{{ route('toggleStatus', $lawyer->id) }}">
                                                @csrf
                                                <label class="switch">
                                                    <input type="checkbox" name="status" onchange="this.form.submit()"
                                                        {{ $lawyer->is_active ? 'checked' : '' }}>
                                                    <span class="slider round"></span>
                                                </label>
                                            </form>
                                        </div>
                                    @endrole
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="student-personals-grp">
                                <div class="card">
                                    <div class="card-body profile">
                                        <div class="heading-detail">
                                            <h4>@lang('pages.personal_details')</h4>
                                        </div>

                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-user"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>@lang('pages.name')</h4>
                                                <h5>{{ $lawyer->name }}</h5>
                                            </div>
                                        </div>


                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-phone-call"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>@lang('pages.mobile')</h4>
                                                <h5>{{ $lawyer->phone }}</h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-mail"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>@lang('pages.email')</h4>
                                                <h5> {{ $lawyer->email }} </h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-user"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>@lang('pages.gender')</h4>
                                                <h5>{{ $lawyer->gender == 1 ? @lang('pages.male') : @lang('pages.fimale') }}</h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-calendar"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>@lang('pages.date_of_birth')</h4>
                                                <h5>{{ $lawyer->birth }}</h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="fas fa-money-bill-alt"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>@lang('pages.consultation_price')</h4>
                                                <h5>{{ $lawyer->consultation_price }}</h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            @if ($lawyer->is_active)
                                                <div class="personal-icons">
                                                    <i class="fas fa-check-circle"></i>
                                                </div>
                                                <div class="views-personal">
                                                    <h4>@lang('pages.status')</h4>
                                                    <h5> @lang('pages.active') </h5>
                                                </div>
                                            @else
                                                <div class="personal-icons">
                                                    <i class="fas fa-times-circle"></i>
                                                </div>
                                                <div class="views-personal">
                                                    <h4>@lang('pages.status')</h4>
                                                    <h5>@lang('pages.non_active')</h5>
                                                </div>
                                            @endif

                                        </div>
                                        <div class="personal-activity ">
                                            <div class="personal-icons">
                                                <i class="feather-map-pin"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>@lang('pages.location')</h4>
                                                <h5>{{ $lawyer->location ? \App\Enums\LocationEnum::getDescription(@lang('EnumFile.'.$lawyer->location)) : 'Unknown' }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="fas fa-certificate"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>@lang('pages.years_of_practice')</h4>
                                                <h5>{{ $lawyer->years_of_practice }} @lang('pages.years')</h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity mb-0">
                                            <div class="personal-icons">
                                                <i class="far fa-clock"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>@lang('pages.date_of_join')</h4>
                                                <h5>{{ $lawyer->created_at?->format('Y-m-d') }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="student-personals-grp">
                                <div class="card mb-0">
                                    <div class="card-body profile">
                                        <div class="heading-detail">
                                            <h4>@lang('pages.certifications')</h4>
                                        </div>
                                        <div class="hello-park">
                                            <div class="certificate">
                                                @foreach ($lawyer->getMedia('certification') as $certificate)
                                                    <img src="{{ asset($certificate->getUrl()) }}" alt="Certificate">
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="hello-park" style="margin-top: 1.5rem">
                                            <h4>@lang('pages.practiece')</h4>

                                            <div class="educate-year">
                                                <div class="follow-btn-group">
                                                    @if ($practices != null)
                                                        @foreach ($practices as $practice)
                                                            <button type="submit"
                                                                class="btn btn-info follow-btns">{{ $practice->name }}</button>
                                                        @endforeach
                                                    @endif

                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="row">

                        <div class="col-lg-12">
                            <div class="student-personals-grp">
                                <div class="card">
                                    <div class="card-body profile">
                                        <div class="heading-detail">
                                            <h4>@lang('pages.consultation')</h4>
                                        </div>
                                        @foreach ($lawyer?->consultations->take(2) as $consultation)
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $consultation->title }}</h5>
                                                    <p class="card-text">{{ $consultation->description }}</p>
                                                    <div class="row">
                                                        <div class="col">
                                                            <span><i class="far fa-money-bill-alt"></i> @lang('pages.amount')</span>
                                                            <h6 class="mb-0">$1,54,220</h6>
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
                                                            <span
                                                                class="badge {{ $badgeColor }}">@lang('EnumFile.'.$statusDescription)</span>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        @php
                                            $encodedId = base64_encode($lawyer->id);
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
                                        @foreach ($lawyer?->replies->take(2) as $reply)
                                            <li>
                                                <div class="comment">
                                                    <div class="comment-author">
                                                        <img class="avatar" alt=""
                                                            src="{{ $reply->generalQuestion->user->getFirstMediaUrl('profileUser') }}">
                                                    </div>
                                                    <div class="comment-block">
                                                        <div class="comment-by">
                                                            <h5 class="blog-author-name">
                                                                {{ $reply->generalQuestion->user->name }} <span
                                                                    class="blog-date"> <i
                                                                        class="feather-clock me-1"></i>{{ $reply->generalQuestion->created_at?->format('Y-m-d') }}</span>
                                                            </h5>
                                                        </div>
                                                        <p>{{ $reply->generalQuestion->question }}</p>
                                                        <a class="comment-btn">
                                                            <i class="fa fa-reply me-2"></i> @lang('pages.replies')
                                                        </a>
                                                    </div>
                                                </div>
                                                <ul class="comments-list reply">
                                                    <li>
                                                        <div class="comment">
                                                            <div class="comment-author">
                                                                <img class="avatar" alt=""
                                                                    src="{{ $reply->user->getFirstMediaUrl('profileUser') }}">
                                                            </div>
                                                            <div class="comment-block">
                                                                <div class="comment-by">
                                                                    <h5 class="blog-author-name">
                                                                        {{ $reply->user->name }} <span class="blog-date">
                                                                            <i class="feather-clock me-1"></i>
                                                                            {{ $reply->created_at?->format('j M Y') }}</span>
                                                                    </h5>
                                                                </div>
                                                                <p>{{ $reply->reply }}</p>

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
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                    @php
                                        $encodedId = base64_encode($lawyer->id);

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
@endsection

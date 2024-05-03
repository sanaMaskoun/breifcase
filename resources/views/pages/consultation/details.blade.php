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
            @if (Session::has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('error') }}
                </div>
            @endif
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="card invoice-info-card">
                        <div class="card-body">
                            <div class="invoice-item invoice-item-one">
                                <div class="row">

                                    <div class="invoice-sign text-end col-md-6">

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
                                        <span class="badge {{ $badgeColor }}"
                                            style="padding: 1rem;
                                            font-size: 19px;">@lang('EnumFile.'.$statusDescription)</span>
                                    </div>
                                </div>
                            </div>



                            <div class="invoice-item invoice-item-two">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="invoice-info">
                                            <h4>@lang('pages.consultation_details')</h4>
                                            <p><strong>@lang('pages.title')</strong> {{ $consultation->title }}</p>
                                            <p><strong>@lang('pages.description')</strong> {{ $consultation->description }} </p>
                                            <div class="card-body " style="padding-left: 0">
                                                <div class="row align-items-start">
                                                    <div class="col-lg-4">
                                                        <span><i class="far fa-money-bill-alt"></i> @lang('pages.amount')</span>
                                                        <h6 class="mb-0">{{ $consultation->receiver->consultation_price }}
                                                        </h6>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <span><i class="far fa-calendar-alt"></i> @lang('pages.created_at')</span>
                                                        <h6 class="mb-0">{{ $consultation->created_at?->format('Y-m-d') }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="invoice-info">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h4>@lang('pages.communication')</h4>
                                                    <h4>@lang('pages.response_time')</h4>
                                                    <h4>@lang('pages.problem_solving')</h4>
                                                    <h4>@lang('pages.understanding.')</h4>
                                                </div>
                                                <div class="col-md-6">
                                                    <h4>
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $consultation->rate?->communication)
                                                                <span class="rating-star"><i class="fas fa-star"
                                                                        style="color: #9b3d00"></i></span>
                                                            @else
                                                                <span class="rating-star"><i class="far fa-star"
                                                                        style="color: #9b3d00"></i></span>
                                                            @endif
                                                        @endfor
                                                    </h4>
                                                    <h4>
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $consultation->rate?->response_time)
                                                                <span class="rating-star"><i class="fas fa-star"
                                                                        style="color: #9b3d00"></i></span>
                                                            @else
                                                                <span class="rating-star"><i class="far fa-star"
                                                                        style="color: #9b3d00"></i></span>
                                                            @endif
                                                        @endfor
                                                    </h4>
                                                    <h4>
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $consultation->rate?->problem_solving)
                                                                <span class="rating-star"><i class="fas fa-star"
                                                                        style="color: #9b3d00"></i></span>
                                                            @else
                                                                <span class="rating-star"><i class="far fa-star"
                                                                        style="color: #9b3d00"></i></span>
                                                            @endif
                                                        @endfor
                                                    </h4>
                                                    <h4>
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $consultation->rate?->understanding)
                                                                <span class="rating-star"><i class="fas fa-star"
                                                                        style="color: #9b3d00"></i></span>
                                                            @else
                                                                <span class="rating-star"><i class="far fa-star"
                                                                        style="color: #9b3d00"></i></span>
                                                            @endif
                                                        @endfor
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>




                        <div class="invoice-item invoice-item-two">
                            <div class="row mb-4 " style="margin-left: 10px">
                                <div class="col-md-6">
                                    <div class="invoice-info">
                                        <h4>@lang('pages.client_information')</h4>
                                        <p><strong>@lang('pages.name')</strong> {{ $consultation->sender->name }}</p>
                                        <p><strong>@lang('pages.email')</strong> {{ $consultation->sender->email }}</p>
                                        <p><strong>@lang('pages.mobile')</strong> {{ $consultation->sender->phone }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <div class="invoice-info">
                                        <h4>@lang('pages.lawyer_information')</h4>
                                        <p><strong>@lang('pages.name')</strong> {{ $consultation->receiver->name }}</p>
                                        <p><strong>@lang('pages.email')</strong> {{ $consultation->receiver->email }}</p>
                                        <p><strong>@lang('pages.mobile')</strong> {{ $consultation->receiver->phone }}</p>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 " style="margin-left: 10px">
                                <div class="invoice-terms">
                                    <h4>@lang('pages.lawyer_reply')</h4>
                                    @if ($consultation->answer === null && $consultation->receiver_id === Auth()->user()->id)
                                        <form method="POST" action="{{route('answer_consultation',$consultation->id) }}">
                                                @csrf
                                                <div class="row">


                                                    <div class="col-12 col-sm-4">
                                                        <div class="form-group local-forms">
                                                            <input type="text" name="answer" class="form-control">
                                                            @error('answer')
                                                                <small class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                    </div>





                                                    <div class="col-12">
                                                        <div class="student-submit">
                                                            <button type="submit" class="btn btn-primary">@lang('pages.send')</button>
                                                        </div>
                                                    </div>
                                                </div>
                                        </form>
                                    @endif
                                    <p>{{ $consultation->answer }}</p>
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

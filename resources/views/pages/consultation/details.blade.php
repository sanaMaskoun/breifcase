@extends('master.app')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="card invoice-info-card">
                        <div class="card-body">
                            <div class="invoice-item invoice-item-one">
                                <div class="row">
                                    {{--  <div class="col-md-12">  --}}
                                    <div class="invoice-logo col-md-6">
                                        <img src="assets/img/logo.png" alt="logo">
                                    </div>

                                    <div class="invoice-sign text-end col-md-6">

                                        @php
                                            $statusDescription = $consultation->status
                                                ? \App\Enums\ConsultationStatusEnum::getDescription(
                                                    $consultation->status,
                                                )
                                                : 'Unknown';
                                            $badgeColor =
                                                $consultation->status == 1
                                                    ? 'bg-danger'
                                                    : ($consultation->status == 2
                                                        ? 'bg-success'
                                                        : 'bg-primary');
                                        @endphp
                                        <span class="badge {{ $badgeColor }}"
                                            style="padding: 1rem;
                                            font-size: 19px;">{{ $statusDescription }}</span>
                                    </div>
                                    {{--  </div>  --}}
                                </div>
                            </div>



                            <div class="invoice-item invoice-item-two">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="invoice-info">
                                            <h4>Consultation Details :</h4>
                                            <p><strong>Title:</strong> {{ $consultation->title }}</p>
                                            <p><strong>Description:</strong> {{ $consultation->description }} </p>
                                            <div class="card-body " style="padding-left: 0">
                                                <div class="row align-items-start">
                                                    <div class="col-lg-4">
                                                        <span><i class="far fa-money-bill-alt"></i> Amount</span>
                                                        <h6 class="mb-0">{{ $consultation->receiver->consultation_price }}
                                                        </h6>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <span><i class="far fa-calendar-alt"></i> Due Date</span>
                                                        <h6 class="mb-0">{{ $consultation->created_at?->format('Y-m-d') }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="invoice-info">
                                            <h4>Communication :
                                                <span>
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $consultation->rate?->communication)
                                                            <span class="rating-star"><i class="fas fa-star"
                                                                    style="color: rgb(242, 187, 6);"></i></span>
                                                        @else
                                                            <span class="rating-star"><i class="far fa-star"
                                                                    style="color: rgb(242, 187, 6);"></i></span>
                                                        @endif
                                                    @endfor
                                                </span>
                                            </h4>
                                            <h4>Response Time :

                                                <span>
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $consultation->rate?->response_time)
                                                            <span class="rating-star"><i class="fas fa-star"
                                                                    style="color: rgb(242, 187, 6);"></i></span>
                                                        @else
                                                            <span class="rating-star"><i class="far fa-star"
                                                                    style="color: rgb(242, 187, 6);"></i></span>
                                                        @endif
                                                    @endfor
                                                </span>
                                            </h4>

                                            <h4>Problem Solving :
                                                <span>
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $consultation->rate?->problem_solving)
                                                            <span class="rating-star"><i class="fas fa-star"
                                                                    style="color: rgb(242, 187, 6);"></i></span>
                                                        @else
                                                            <span class="rating-star"><i class="far fa-star"
                                                                    style="color: rgb(242, 187, 6);"></i></span>
                                                        @endif
                                                    @endfor
                                                </span>
                                            </h4>
                                        </div>
                                        <h4>Understanding :
                                            <span>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $consultation->rate?->understanding)
                                                        <span class="rating-star"><i class="fas fa-star"
                                                                style="color: rgb(242, 187, 6);"></i></span>
                                                    @else
                                                        <span class="rating-star"><i class="far fa-star"
                                                                style="color: rgb(242, 187, 6);"></i></span>
                                                    @endif
                                                @endfor
                                            </span>
                                        </h4>

                                    </div>
                                </div>

                            </div>
                        </div>




                        <div class="invoice-item invoice-item-two">
                            <div class="row mb-4 " style="margin-left: 10px">
                                <div class="col-md-6">
                                    <div class="invoice-info">
                                        <h4>Client Information :</h4>
                                        <p><strong>Name:</strong> {{ $consultation->sender->name }}</p>
                                        <p><strong>Email:</strong> {{ $consultation->sender->email }}</p>
                                        <p><strong>Phone:</strong> {{ $consultation->sender->phone }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <div class="invoice-info">
                                        <h4>Lawyer Information :</h4>
                                        <p><strong>Name:</strong> {{ $consultation->receiver->name }}</p>
                                        <p><strong>Email:</strong> {{ $consultation->receiver->email }}</p>
                                        <p><strong>Phone:</strong> {{ $consultation->receiver->phone }}</p>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 " style="margin-left: 10px">
                                <div class="invoice-terms">
                                    <h4>The lawyer answer to the consultation :</h4>
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

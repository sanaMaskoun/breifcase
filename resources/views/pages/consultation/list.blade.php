@extends('master.app')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">@lang('pages.consultation') </h3>
                    </div>
                </div>
            </div>
            <form method="GET" action="{{ route('list_consultations') }}">
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">@lang('pages.status')</label>
                            <select name="status" id="status" class="form-control">
                                <option value=""></option>
                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>@lang('EnumFile.Ongoing')</option>
                                <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>@lang('EnumFile.Closed')</option>
                                <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>@lang('EnumFile.Pending')</option>
                                <option value="4" {{ request('status') == '4' ? 'selected' : '' }}>@lang('EnumFile.Rejected')</option>
                            </select>
                            <button class="btn btn_status" type="submit"><i class="fas fa-search"></i></button>

                        </div>
                    </div>

                </div>
            </form>

            <div class="row">
                @foreach ($consultations as $consultation)
                    @php
                        $encodedId = base64_encode($consultation->id);
                    @endphp
                    <div class="col-sm-6 col-lg-4 col-xl-3 d-flex">
                        <div class="card invoices-grid-card w-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <a href="{{ route('show_consultation', $encodedId) }}"
                                    class="invoice-grid-link">{{ $consultation->title }}</a>
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end">

                                        <a class="dropdown-item"
                                            href="{{ route('show_consultation', $encodedId) }}"><i
                                                class="far fa-eye me-2"></i>View</a>

                                    </div>
                                </div>
                            </div>
                            <div class="card-middle">
                                <h2 class="card-middle-avatar">
                                    <a href="{{ route('show_client', $encodedId) }}"><img
                                            class="avatar avatar-sm me-2 avatar-img rounded-circle"
                                            src="{{ $consultation->sender->getFirstMediaUrl('profileUser') }}"
                                            alt="User Image"> {{ $consultation->sender->name }}</a>
                                </h2>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <span><i class="far fa-money-bill-alt"></i> @lang('pages.amount')</span>
                                        <h6 class="mb-0">{{ $consultation->receiver->consultation_price }}</h6>
                                    </div>
                                    <div class="col-auto">
                                        <span><i class="far fa-calendar-alt"></i>@lang('pages.created_at')</span>
                                        <h6 class="mb-0">{{ $consultation->created_at?->format('Y-m-d') }}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row align-items-center">
                                    <div class="col-auto">
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
                    </div>
                @endforeach

                <div class="pagination">
                    <span class="page-info">@lang('pagination.pages') {{ $consultations->currentPage() }} @lang('pagination.of')
                        {{ $consultations->lastPage() }}</span>
                    <a href="{{ $consultations->previousPageUrl() }}" class="prev"
                        @if (!$consultations->previousPageUrl()) disabled @endif>@lang('pagination.previous')</a>
                    <a href="{{ $consultations->nextPageUrl() }}" class="next"
                        @if (!$consultations->nextPageUrl()) disabled @endif>@lang('pagination.next')</a>
                </div>
            </div>
        </div>
    </div>
@endsection

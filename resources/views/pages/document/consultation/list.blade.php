@extends('pages.dashboard.sidebar')
@section('dashboard')
    {{--  <div class="col-lg-9 col-md-1">  --}}
        <div class="content ">
            <div class="header-documents-dashboard">
                <h2>@lang('pages.consultations')</h2>
                <span class="num-documents">@lang('pages.total') {{ $num_consultations }} </span>

            </div>
            <div class="search-status mt-2">
                <input value="{{ request('search') }}" name="search" type="text"
                    class="form-control form-input input-search-status" id="statusSearch" placeholder="@lang('pages.status')" />
            </div>
            <div class="list-document-dashboard">
                @foreach ($consultations as $consultation)
                    <div class="col-lg-3 col-md-6 col-sm-12  mt-4 document-item">
                        <a class="title-details text-center"
                            href="{{ route('details_consultation', base64_encode($consultation->id)) }}">
                            <img src="{{ asset('assets/img/consultation.png') }}" alt="Consultation Image"
                                class="icon-dasbboard-admin">
                            <h5 class="title-document-dashboard">{{ $consultation->title }}</h5>
                        </a>
                        <div class="container-details-document-dashboard text-center">
                            {{--  <p class="details-document-dashboard">{{ $consultation->sender->name }}</p>  --}}
                            <p class="details-document-dashboard">{{ $consultation->created_at->format('Y/m/d') }}</p>
                            <div class="status-consultation {{ strtolower($status_texts[$consultation->status]) }}">
                                @lang('EnumFile.' . $status_texts[$consultation->status])
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    {{--  </div>  --}}
@endsection

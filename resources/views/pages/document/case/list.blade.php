@extends('pages.dashboard.sidebar')
@section('dashboard')
    {{--  <div class="col-lg-9 col-md-1">  --}}
        <div class="content">
            <div class="header-documents-dashboard">
                <h2>@lang('pages.cases')</h2>
                <span class="num-document">@lang('pages.total') {{ $num_cases }} </span>


            </div>
            <div class="search-status mt-2">
                <input value="{{ request('search') }}" name="search" type="text"
                    class="form-control form-input input-search-status" id="statusSearch" placeholder="@lang('pages.status')" />
            </div>
            <div class="list-document-dashboard row">
                @foreach ($cases as $case)
                    <div class="col-lg-3 col-md-6 col-sm-12 mt-4 document-item">
                        <a class="title-details text-center" href="{{ route('show_case', base64_encode($case->id)) }}">
                            <img src="{{ asset('assets/img/case.png') }}" alt="case Image" class="icon-dasbboard-admin">
                            <h5 class="title-document-dashboard">{{ $case->title }}</h5>
                        </a>
                        <div class="container-details-document-dashboard text-center">
                            {{--  <p class="details-document-dashboard">{{ $case->receiver->name }}</p>  --}}
                            <p class="details-document-dashboard">{{ $case->created_at->format('Y/m/d') }}</p>
                            <div class="status-consultation {{ strtolower($status_texts[$case->status]) }}">
                                @lang('EnumFile.' . $status_texts[$case->status])
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    {{--  </div>  --}}
@endsection

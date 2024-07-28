@extends('pages.client.show')

@section('profile_content')
<div class="box-profile-1 ">
    <div class="tab">
        <button class="tablinks" onclick="openCity(event, 'Consultations')">@lang('pages.consultations') </button>
        <button class="tablinks" onclick="openCity(event, 'Cases')">@lang('pages.cases') </button>
        <button class="tablinks" onclick="openCity(event, 'request')">@lang('pages.translateFile') </button>
    </div>
    <div class="search-status mt-2">
        <input value="{{ request('search') }}" name="search" type="text"
            class="form-control form-input input-search-status" id="statusSearch" placeholder="@lang('pages.status')" />
    </div>

    <div id="Consultations" class="tabcontent">

        @foreach ($consultations as $consultation)
        <div class="col-lg-3 col-md-6 col-sm-12  mt-4 document-item">
            <a class="title-details text-center"
                href="{{ route('show_client_consultation', base64_encode($consultation->id)) }}">
                <img src="{{ asset('assets/img/consultation.png') }}" alt="Consultation Image"
                    class="icon-dasbboard-admin">
                <h5 class="title-document-dashboard">{{ $consultation->title }}</h5>
            </a>
            <div class="container-details-document-dashboard text-center">
                <p class="details-document-dashboard">{{ $consultation->created_at->format('Y/m/d') }}</p>
                <div class="status-consultation {{ strtolower($status_texts[$consultation->status]) }}">
                    {{ $status_texts[$consultation->status] }}
                </div>
            </div>

        </div>
        @endforeach
    </div>

    <div id="Cases" class="tabcontent">

        @foreach ($cases as $case)
        <div class="col-lg-3 col-md-6 col-sm-12 mt-4 document-item">
            <a class="title-details text-center" href="{{ route('show_client_case', base64_encode($case->id)) }}">
                <img src="{{ asset('assets/img/case.png') }}" alt="case Image" class="icon-dasbboard-admin">
                <h5 class="title-document-dashboard">{{ $case->title }} </h5>
            </a>
            <div class="container-details-document-dashboard text-center">
                {{--  <p class="details-document-dashboard">{{ $case->receiver->name }}</p>  --}}
                <p class="details-document-dashboard">{{ $case->created_at->format('Y/m/d') }}</p>
                <div class="status-consultation {{ strtolower($status_texts[$case->status]) }}">
                    {{ $status_texts[$case->status] }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div id="request" class="tabcontent">

        @foreach ($requests as $request)
        <div class="col-lg-3 col-md-6 col-sm-12 mt-4 document-item">
            <a class="title-details text-center" href="{{ route('show_client_request', base64_encode($request->id)) }}">
                <img src="{{ asset('assets/img/template-dashboard.png') }}" alt="case Image" class="icon-dasbboard-admin">
                <h5 class="title-document-dashboard">{{ $request->title }} </h5>
            </a>
            <div class="container-details-document-dashboard text-center">
                {{--  <p class="details-document-dashboard">{{ $case->receiver->name }}</p>  --}}
                <p class="details-document-dashboard">{{ $request->created_at->format('Y/m/d') }}</p>
                <div class="status-consultation {{ strtolower($status_texts[$request->status]) }}">
                    {{ $status_texts[$request->status] }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

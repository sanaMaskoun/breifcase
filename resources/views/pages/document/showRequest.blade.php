@extends('pages.dashboard.sidebar')
@section('dashboard')
    {{--  <div class="col-lg-9 col-md-1">  --}}
        <div class="content">
            <div class="d-flex justify-content-between">
                <h2>{{ $request->title }}</h2>
                <div class="status-consultation {{ strtolower($status_texts[$request->status]) }}">
                    @lang('EnumFile.' . $status_texts[$request->status])
                </div>
            </div>

            <div class="case-details-content ml-3">
                <h6>@lang('pages.lawyer_name') : <span>{{ $request->sender->name }}</span></h6>
                <h6>@lang('pages.client_name') : {{ $request->receiver->name }}</h6>
                <h6>@lang('pages.description') : {{ $request->description }}</h6>
                <br>
                <br>
                <div class="col-md-3 text-center">
                    <h5>@lang('pages.shared_documents') </h5>

                </div>

                <div class="col-md-6 mb-3">
                    @php
                        $mediaUrlRequest = $request->getFirstMediaUrl('translateFile');
                        $mimeTypeRequest = $request->getFirstMedia('translateFile')
                            ? $request->getFirstMedia('translateFile')->mime_type
                            : null;

                    @endphp

                    @if ($mimeTypeRequest && str_starts_with($mimeTypeRequest, 'image'))
                        <img alt="" src="{{ $mediaUrlRequest }}" class="clickable case-details-content-img">
                    @elseif ($mimeTypeRequest === 'application/pdf')
                        <a href="{{ $mediaUrlRequest }}" target="_blank">
                            <img alt="PDF file" class="case-details-content-img" src="{{ asset('assets/img/pdf.jpg') }}">
                        </a>
                    @else
                        <a href="{{ $mediaUrlRequest }}" target="_blank">
                            <img alt="Word file" class="case-details-content-img" src="{{ asset('assets/img/word.png') }}">
                        </a>
                    @endif

                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('bill_show', base64_encode($request->invoice?->id)) }}" class="btn-bill ">
                        @lang('pages.bills')
                                      </a>
                </div>


            </div>


        </div>
    {{--  </div>  --}}
@endsection

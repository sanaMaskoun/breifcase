@extends('pages.dashboard.sidebar')
@section('dashboard')
    <div class="col-lg-9 col-md-1">
        <div class="content">

            {{--  <div class="list-document-dashboard">  --}}
            <div class="d-flex justify-content-between">
                <h2>{{ $request->title }}</h2>
                <div class="status-consultation {{ strtolower($status_texts[$request->status]) }}">
                    {{ $status_texts[$request->status] }}
                </div>
            </div>

            <div class="case-details-content ml-3">
                <h6>Lawyer name: <span>{{ $request->sender->name }}</span></h6>
                <h6>Client name: {{ $request->receiver->name }}</h6>
                <h6>Description: {{ $request->description }}</h6>
                <br>
                <br>
                {{--  <div class="row ">  --}}
                <div class="col-md-3 text-center">
                    <h5>Shared Documents</h5>

                </div>
                {{--  </div>  --}}
                {{--  <div class="row">  --}}
                <div class="col-md-6 mb-3">
                    @php
                        $mediaUrlRequest = $request->getFirstMediaUrl('translateFile');
                        $mimeTypeRequest = $request->getFirstMedia('translateFile')
                            ? $request->getFirstMedia('translateFile')->mime_type
                            : null;

                    @endphp

                    @if ($mimeTypeRequest && str_starts_with($mimeTypeRequest, 'image'))
                        <img alt="" src="{{ $mediaUrlRequest }}" class="clickable">
                    @elseif ($mimeTypeRequest === 'application/pdf')
                        <a href="{{ $mediaUrlCase }}" target="_blank">
                            <img alt="PDF file" src="{{ asset('assets/img/pdf.jpg') }}">
                        </a>
                    @else
                        <a href="{{ $mediaUrlRequest }}" target="_blank">
                            <img alt="Word file" src="{{ asset('assets/img/word.png') }}">
                        </a>
                    @endif

                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('bill_show', base64_encode($request->invoice?->id)) }}" class="btn-bill ">
                        Bill and  Receipt
                    </a>

                    @if ($status_texts[$request->status] === 'Ongoing')
                    <form id="close-case-form-{{ $request->id }}" method="POST" action="{{ route('closed_request', base64_encode($request->id)) }}" style="display: none;">
                        @csrf
                    </form>

                    <a href="#" class="btn-close-consultation" onclick="event.preventDefault(); document.getElementById('close-case-form-{{ $request->id }}').submit();">
                        Close the request
                    </a>

                    @endif
                </div>


            </div>


        </div>
    </div>
@endsection

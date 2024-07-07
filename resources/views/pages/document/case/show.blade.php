@extends('pages.dashboard.sidebar')
@section('dashboard')
    <div class="col-lg-9 col-md-1">
        <div class="content">

            {{--  <div class="list-document-dashboard">  --}}
            <h2>Case title: {{ $case->title }}</h2>
            <div class="case-details-content ml-3">
                <h6>Lawyer name: <span>{{ $case->sender->name }}</span></h6>
                <h6>Client name: {{ $case->receiver->name }}</h6>
                <br>
                <br>
                <div class="row ">
                    <div class="col-md-3 text-center">
                        <h5>Shared Documents</h5>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        @php
                            $mediaUrl = $case->getFirstMediaUrl('case_template');
                            $mimeType = $case->getFirstMedia('case_template')->mime_type;
                        @endphp

                        @if (str_starts_with($mimeType, 'image'))
                            <img alt="" src="{{ $mediaUrl }}" class="clickable">

                        @elseif ($mimeType === 'application/pdf')
                            <a href="{{ $mediaUrl }}" target="_blank">
                                <img alt="PDF file" src="{{ asset('assets/img/pdf.jpg') }}" >
                            </a>
                        @elseif ($mimeType === 'application/msword' || $mimeType === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                            <a href="{{ $mediaUrl }}" target="_blank">
                                <img alt="Word file" src="{{ asset('assets/img/word.png') }}">
                            </a>
                        @else
                            <p>File format not supported.</p>
                        @endif
                    </div>
                </div>



            </div>
            {{--  </div>  --}}

        </div>
    </div>
@endsection

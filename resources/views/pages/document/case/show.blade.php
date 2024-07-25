@extends('pages.dashboard.sidebar')
@section('dashboard')
    <div class="col-lg-9 col-md-1">
        <div class="content">

            {{--  <div class="list-document-dashboard">  --}}
            <div class="d-flex justify-content-between">
                <h2>{{ $case->title }}</h2>
                <div class="status-consultation {{ strtolower($status_texts[$case->status]) }}">
                    {{ $status_texts[$case->status] }}
                </div>
            </div>

            <div class="case-details-content ml-3">
                <h6>Lawyer name: <span>{{ $case->sender->name }}</span></h6>
                <h6>Client name: {{ $case->receiver->name }}</h6>
                <h6>Description: {{ $case->description }}</h6>
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
                        $mediaUrlCase = $case->getFirstMediaUrl('case_template');
                        $mediaUrlAccept = $case->getFirstMediaUrl('accept_case');
                        $mimeTypeCase = $case->getFirstMedia('case_template')
                            ? $case->getFirstMedia('case_template')->mime_type
                            : null;
                        $mimeTypeAccept = $case->getFirstMedia('accept_case')
                            ? $case->getFirstMedia('accept_case')->mime_type
                            : null;
                    @endphp

                    @if ($mimeTypeCase && str_starts_with($mimeTypeCase, 'image'))
                        <img alt="" src="{{ $mediaUrlCase }}" class="clickable">
                    @elseif ($mimeTypeCase === 'application/pdf')
                        <a href="{{ $mediaUrlCase }}" target="_blank">
                            <img alt="PDF file" src="{{ asset('assets/img/pdf.jpg') }}">
                        </a>


                        {{--  @elseif ($mimeTypeCase === 'application/msword' || $mimeTypeCase === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                            <a href="{{ $mediaUrlCase }}" target="_blank">
                                <img alt="Word file" src="{{ asset('assets/img/word.png') }}">
                            </a>
                             --}}
                    @else
                        <a href="{{ $mediaUrlCase }}" target="_blank">
                            <img alt="Word file" src="{{ asset('assets/img/word.png') }}">
                        </a>
                    @endif


                    @if ($mimeTypeAccept && str_starts_with($mimeTypeAccept, 'image'))
                        <img alt="" src="{{ $mediaUrlAccept }}" class="clickable">
                    @elseif ($mimeTypeAccept === 'application/pdf')
                        <a href="{{ $mediaUrlAccept }}" target="_blank">
                            <img alt="PDF file" src="{{ asset('assets/img/pdf.jpg') }}">
                        </a>
                    @else
                        <a href="{{ $mediaUrlAccept }}" target="_blank">
                            <img alt="Word file" src="{{ asset('assets/img/word.png') }}">
                        </a>
                    @endif

                </div>

                {{--  </div>  --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('bill_show', base64_encode($case->invoice?->id)) }}" class="btn-bill ">
                        Bill and  Receipt
                    </a>

                    @if ($status_texts[$case->status] === 'Ongoing')
                    <form id="close-case-form-{{ $case->id }}" method="POST" action="{{ route('closed_case', base64_encode($case->id)) }}" style="display: none;">
                        @csrf
                    </form>

                    <a href="#" class="btn-close-consultation" onclick="event.preventDefault(); document.getElementById('close-case-form-{{ $case->id }}').submit();">
                        Close the case
                    </a>

                    @endif
                </div>


            </div>

            {{--  </div>  --}}

        </div>
    </div>
@endsection

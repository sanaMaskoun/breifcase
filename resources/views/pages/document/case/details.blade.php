@extends('master.app')
@section('content')

    
    <div class="container mt-5">
        <div class="card-case">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mt-5 ">
                        <p class="title-consultation-details">Title: {{ $case->title }}</p>
                        <p class="description-consultation-details">Description: {{ $case->description }}</p>
                        <p>price: {{ $case->price }} </p>
                        <p>{{ $case->sender->name }}</p>
                        <span class="d-flex justify-content-end">{{ $case->created_at->format('Y/m/d') }}</span>

                    </div>
                    <div class="col-md-6 mt-5">
                        <div class="text-center details-template-case d-inline-block position-relative">
                            @php
                                $mediaUrl = $case->getFirstMediaUrl('case_template');
                                $mimeType = $case->getFirstMedia('case_template')->mime_type;
                            @endphp

                            @if (str_starts_with($mimeType, 'image'))
                                <img alt="" src="{{ $mediaUrl }}" class="clickable template-case">
                            @elseif ($mimeType === 'application/pdf')
                                <a href="{{ $mediaUrl }}" target="_blank">
                                    <img alt="PDF file" class="template-case" src="{{ asset('assets/img/pdf.jpg') }}">
                                </a>
                            @elseif (
                                $mimeType === 'application/msword' ||
                                    $mimeType === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                <a href="{{ $mediaUrl }}" target="_blank">
                                    <img alt="Word file" class="template-case" src="{{ asset('assets/img/word.png') }}">
                                </a>
                            @else
                                <p>File format not supported.</p>
                            @endif
                            @role('client')
                                @if (
                                    !(
                                        $mimeType === 'application/msword' ||
                                        $mimeType === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                                    ))
                                    <a href="{{ $mediaUrl }}" class="download-icon" download>
                                        <i class="fas fa-download"></i>
                                    </a>
                                @endif
                            @endrole
                        </div>
                        @role('client')
                            <div class="mt-3">
                                <form action="{{ route('accept_case', base64_encode($case->id)) }}" method="POST"
                                    enctype="multipart/form-data" class="d-inline-block">
                                    @csrf
                                    <div class="form-group mt-2 d-flex">
                                        <input type="file" class="form-control" id="accept_case" name="accept_case">
                                        @error('accept_case')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-success mr-2">Accept</button>
                                </form>
                                <form action="{{ route('reject_case', base64_encode($case->id)) }}" method="POST"
                                    class="d-inline-block">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Reject</button>
                                </form>
                            </div>
                        @endrole
                    </div>


                </div>
            </div>




            <div class=" text-center">
            </div>

        </div>
    @endsection

@extends('pages.client.show')
@section('profile_content')
    <div class="container box-profile-1 ">
        <div class="d-flex justify-content-between">
            <h2>{{ $request->title }}</h2>
            <div class="status-consultation {{ strtolower($status_texts[$request->status]) }}">
                {{ $status_texts[$request->status] }}
            </div>
        </div>

        <div class=" ml-3">
            <h6>Lawyer name: <span>{{ $request->sender->name }}</span></h6>
            <h6>Client name: {{ $request->receiver->name }}</h6>
            <h6>Description: {{ $request->description }}</h6>
            <br>
            <br>
            <div class=" text-center">
                <h5>Shared Documents</h5>

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

            @if ($status_texts[$request->status] === 'Closed' && $request->rating === null)
                <div class=" feedback-form">
                    <form action="{{ route('rating', base64_encode($request->id)) }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="communication">Communication:</label>
                            <div id="communication-rating" class="star-rating">
                                <span class="star" data-value="1">&#9733;</span>
                                <span class="star" data-value="2">&#9733;</span>
                                <span class="star" data-value="3">&#9733;</span>
                                <span class="star" data-value="4">&#9733;</span>
                                <span class="star" data-value="5">&#9733;</span>
                            </div>
                            <input type="hidden" name="communication" id="communication" value="0">
                        </div>
                        <div class="form-group">
                            <label for="response_time">Response Time:</label>
                            <div id="response_time-rating" class="star-rating">
                                <span class="star" data-value="1">&#9733;</span>
                                <span class="star" data-value="2">&#9733;</span>
                                <span class="star" data-value="3">&#9733;</span>
                                <span class="star" data-value="4">&#9733;</span>
                                <span class="star" data-value="5">&#9733;</span>
                            </div>
                            <input type="hidden" name="response_time" id="response_time" value="0">
                        </div>
                        <div class="form-group">
                            <label for="problem_solving">Problem Solving:</label>
                            <div id="problem_solving-rating" class="star-rating">
                                <span class="star" data-value="1">&#9733;</span>
                                <span class="star" data-value="2">&#9733;</span>
                                <span class="star" data-value="3">&#9733;</span>
                                <span class="star" data-value="4">&#9733;</span>
                                <span class="star" data-value="5">&#9733;</span>
                            </div>
                            <input type="hidden" name="problem_solving" id="problem_solving" value="0">
                        </div>

                        <div class="form-group">
                            <label for="understanding">Understanding:</label>
                            <div id="understanding-rating" class="star-rating">
                                <span class="star" data-value="1">&#9733;</span>
                                <span class="star" data-value="2">&#9733;</span>
                                <span class="star" data-value="3">&#9733;</span>
                                <span class="star" data-value="4">&#9733;</span>
                                <span class="star" data-value="5">&#9733;</span>
                            </div>
                            <input type="hidden" name="understanding" id="understanding" value="0">
                        </div>

                        <div class="form-group">
                            <label for="comment">Comment:</label>
                            <textarea name="comment" id="comment" rows="4" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-feedback ">Submit Feedback</button>
                    </form>
                </div>
            @endif
            <div class="d-flex justify-content-end">
                <a href="{{ route('show_client_invoices', base64_encode($request->invoice?->id)) }}" class="btn-bill ">
                    Bill and Receipt
                </a>




            </div>


        </div>

    </div>
@endsection
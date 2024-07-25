@extends('pages.client.show')
@section('profile_content')
    <div class="container box-profile-1 ">
        <div class="d-flex justify-content-between">

            <h2>consultation Details </h2>
            <div class="status-consultation {{ strtolower($status_texts[$consultation->status]) }}">
                {{ $status_texts[$consultation->status] }}
            </div>
        </div>

        <div class="list-document-dashboard">
            <div class="col-md-6 ">
                <p class="title-consultation-details"> {{ $consultation->title }}</p>
                <p class="description-consultation-details"> {{ $consultation->description }} </p>
                <span class="d-flex justify-content-end">{{ $consultation->sender->name }}</span>
                <span class="d-flex justify-content-end">{{ $consultation->created_at->format('Y/m/d') }}</span>

            </div>
            <div class="col-md-6 body-suggestion">
                <p class="description-consultation-details"> {{ $consultation->answer }}</p>

                <span class="d-flex justify-content-end"> {{ $consultation->receiver->name }} </span>

            </div>

        </div>

        @if ($status_texts[$consultation->status] === 'Closed' && $consultation->rating === null)
            <div class=" feedback-form">
                <form action="{{ route('rating' , base64_encode($consultation->id)) }}" method="POST">
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
            <a href="{{ route('show_client_invoices', base64_encode($consultation->invoice->id)) }}" class="btn-bill">
                Bill and Receipt
            </a>
        </div>



    </div>

@endsection

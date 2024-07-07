@extends('pages.dashboard.sidebar')
@section('dashboard')

    <div class="col-lg-9 col-md-1">
        <div class="content ">
            <h1 class="my-4">Reviews</h1>
            <div class="row">

                @foreach ($rates as $rate )
                <div class="col-lg-6 col-md-6">
                    <div class="review-box">
                        <div class="review">
                            <div class="title-document-rate"> {{ $rate->document->title }}</div>
                            <div class="star-rating">
                                <div class="stars" data-rating="{{ $rate->average_rate }}">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span class="star">★</span>
                                    @endfor
                                </div>
                                {{--  <span class="evaluation"></span>  --}}
                            </div>
                        </div>
                        <input type="text" class="form-control review-input commet-review" value="{{ $rate->comment }}" readonly>
                        <div class="name-client-rate">
                            <span >{{ $rate->client->name}}</span>
                            </div>
                    </div>
                </div>
                @endforeach


            </div>

        </div>
    </div>


@endsection

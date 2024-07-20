@extends('pages.dashboard.sidebar')
@section('dashboard')
    <div class="col-lg-9 col-md-1">
        <div class="content">
            <div class="header-documents-dashboard">
                <h2>Consultaion Details</h2>

            </div>

            <div class="list-document-dashboard">
                <div class="col-md-6 mt-5 ">
                    <p class="title-consultation-details"> {{ $consultaion->title }}</p>
                    <p class="description-consultation-details"> {{ $consultaion->description }} </p>
                    <span class="d-flex justify-content-end">{{ $consultaion->sender->name }}</span>
                    <span class="d-flex justify-content-end">{{ $consultaion->created_at->format('Y/m/d') }}</span>
                </div>
                <div class="col-md-6 mt-5 body-suggestion">
                    <p class="description-consultation-details"> {{ $consultaion->answer }}</p>
                    @if (Auth()->user()->id == $consultaion->receiver_id && $consultaion->answer == null)
                        <form method="POST" action="{{ route('answer_consultaion', base64_encode($consultaion->id)) }}">
                            @csrf
                            <div class="d-flex justify-content-center">
                                <textarea type="text" name="answer" class="form-control"></textarea>
                                @error('answer')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-center mt-2">
                                <button class="answer-consultation">answer</button>

                            </div>
                        </form>
                    @endif
                    <span class="d-flex justify-content-end"> {{ $consultaion->receiver->name }} </span>

                </div>

            </div>

        </div>
    </div>
@endsection

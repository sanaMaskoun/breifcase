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
                    <p  class="description-consultation-details"> {{ $consultaion->answer }}</p>
                    <span class="d-flex justify-content-end"> {{ $consultaion->receiver->name }} </span>
                </div>
            </div>

        </div>
    </div>
@endsection

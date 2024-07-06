@extends('pages.dashboard.sidebar')
@section('dashboard')
    <div class="col-lg-9 col-md-1">
        <div class="content ">
            <div class="header-documents-dashboard">
                <h2>Consultations</h2>
                <span class="num-documents">Total {{ $num_consultations }} </span>

            </div>

            <div class="list-document-dashboard">
                @foreach ($consultations as $consultation)
                    <div class="col-lg-3 col-md-6 col-sm-12  mt-4">
                        <img src="{{ asset('assets/img/consultation.png') }}" alt="Consultation Image" class="img-doc">
                        <a class="title-details" href="{{ route('details_consultaion' , base64_encode($consultation->id)) }}"<h5 class="title-document-dashboard">{{ $consultation->title }}</h5></a>
                        <div class="container-details-document-dashboard">
                            <p class="details-document-dashboard">{{ $consultation->sender->name }}</p>
                            <p class="details-document-dashboard">{{ $consultation->created_at->format('Y/m/d') }}</p>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection

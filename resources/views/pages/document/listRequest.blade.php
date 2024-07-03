@extends('pages.dashboard.sidebar')
@section('dashboard')
    <div class="col-lg-9 col-md-1">
        <div class="content ">
            <div class="header-documents-dashboard">
                <h2>Requests</h2>
                <span class="num-document">Total {{ $num_requests }} </span>

            </div>

            <div class="list-document-dashboard">
                @foreach ($requests as $request)
                    <div class="col-lg-3 col-md-6 col-sm-12  mt-4">
                        <img src="{{ asset('assets/img/template-dashboard.png') }}" alt="request Image" class="img-doc">
                        <h5 class="title-document-dashboard">{{ $request->title }}</h5>
                        <div class="container-details-document-dashboard">
                            <p class="details-document-dashboard">{{ $request->sender->name }}</p>
                            <p class="details-document-dashboard">{{ $request->created_at->format('Y/m/d') }}</p>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection

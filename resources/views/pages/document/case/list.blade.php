@extends('pages.dashboard.sidebar')
@section('dashboard')
    <div class="col-lg-9 col-md-1">
        <div class="content ">
            <div class="header-documents-dashboard">
                <h2>Cases</h2>
                <span class="num-document">Total {{ $num_cases }} </span>

            </div>

            <div class="list-document-dashboard">
                @foreach ($cases as $case)
                    <div class="col-lg-3 col-md-6 col-sm-12  mt-4">
                        <a class="title-details text-center" href="{{ route('details_case', base64_encode($case->id)) }}">
                             <img src="{{ asset('assets/img/case.png') }}" alt="case Image" class="icon-dasbboard-admin">
                            <h5 class="title-document-dashboard">{{ $case->title }}</h5>
                        </a>
                        <div class="container-details-document-dashboard text-center">
                            <p class="details-document-dashboard">{{ $case->sender->name }}</p>
                            <p class="details-document-dashboard">{{ $case->created_at->format('Y/m/d') }}</p>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection

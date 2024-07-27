@extends('pages.dashboard.sidebar')
@section('dashboard')
    {{--  <div class="col-lg-9 col-md-1">  --}}
        <div class="content ">
            <div class="header-documents-dashboard">
                <h2>Practices</h2>
                <span class="num-documents">Total {{ $num_practices }} </span>

            </div>

            <div class="list-document-dashboard">
                @foreach ($practices as $practice)
                    <div class="col-lg-3 col-md-6 col-sm-12 text-center  mt-4">
                        <form method="GET" action="{{ route('delete_practiece', $practice->id) }}">
                            <button type="submit" class="btn-remove-template">
                                <i class="bx bx-x icon-remove-template"></i>
                            </button>
                        </form>
                            <i class="fas fa-balance-scale fa-2x icon-practice"></i>
                            <h5 class="name-practice">{{ $practice->name }}</h5>
                            <div class="container-details-document-dashboard text-center">
                                <p class="details-document-dashboard">{{ $practice->description }}</p>
                            </div>
                    </div>

                @endforeach
            </div>

            <div class="form-group file-upload col-md-12 Template">
                <form method="GET" action="{{ route('add_practiece') }}" enctype="multipart/form-data">
                    @csrf
                    <button type="submit" class="btn_download_book">
                        <i class="fas fa-upload upload-icon-template"></i>
                        add practice
                    </button>

                </form>
            </div>

        </div>
    {{--  </div>  --}}
@endsection

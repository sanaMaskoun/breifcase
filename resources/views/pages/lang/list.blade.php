@extends('pages.dashboard.sidebar')
@section('dashboard')
    <div class="col-lg-9 col-md-1">
        <div class="content ">
            <div class="header-documents-dashboard">
                <h2>Languages</h2>
                <span class="num-documents">Total {{ $num_languages }} </span>

            </div>

            <div class="list-document-dashboard">
                @foreach ($languages as $language)
                    <div class="col-lg-3 col-md-6 col-sm-12 text-center  mt-4">
                        <form method="GET" action="{{ route('delete_language', $language->id) }}">
                            <button type="submit" class="btn-remove-template">
                                <i class="bx bx-x icon-remove-template"></i>
                            </button>
                        </form>
                            <i class="bx bx-globe icon-practice"></i>
                            <h5 class="name-practice">{{ $language->name }}</h5>

                    </div>

                @endforeach
            </div>

            <div class="form-group file-upload col-md-12 Template">
                <form method="GET" action="{{ route('add_language') }}" enctype="multipart/form-data">
                    @csrf
                    <button type="submit" class="btn_download_book">
                        <i class="fas fa-upload upload-icon-template"></i>
                        add language
                    </button>

                </form>
            </div>

        </div>
    </div>
@endsection

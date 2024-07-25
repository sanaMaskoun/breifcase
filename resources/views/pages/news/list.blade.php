@extends('pages.dashboard.sidebar')
@section('dashboard')
    <div class="col-lg-9 col-md-1">
        <div class="content ">
            <div class="header-documents-dashboard">
                <h2>News</h2>
                <span class="num-documents">Total {{ $num_news }} </span>

            </div>

            <div class="list-document-dashboard">
                @foreach ($news as $object)
                    <div class="col-lg-3 col-md-6 col-sm-12 text-center  mt-4">
                        <form method="GET" action="{{ route('delete_news', $object->id) }}">
                            <button type="submit" class="btn-remove-template">
                                <i class="bx bx-x icon-remove-template"></i>
                            </button>
                        </form>
                        <a href="{{ route('show_news', base64_encode($object->id)) }}">
                            <img class=" case-details-content-img" src="{{ $object->getFirstMediaUrl('news')  }}">
                        </a>
                        <h5 class="name-practice">{{ $object->title }}</h5>

                    </div>
                @endforeach
            </div>

            <div class="form-group file-upload col-md-12 Template">
                <form method="GET" action="{{ route('add_news') }}" enctype="multipart/form-data">
                    @csrf
                    <button type="submit" class="btn_download_book">
                        <i class="fas fa-upload upload-icon-template"></i>
                        add news
                    </button>

                </form>
            </div>

        </div>
    </div>
@endsection

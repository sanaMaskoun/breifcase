@extends('master.app')
@section('content')
    <div class=" container mt-5">


        <div class="row text-center content-dashboard  box-book mt-3">

            <div class="row search-bar-lib">
                <div class=" col-lg-12 col-md-12 col-sm-12  search_book">

                    <div class="form-news search-book">
                        <i class="fa fa-search" style="color: black"></i>
                        <input value="" type="text" class="form-control form-input search-book-1"
                            placeholder="@lang('pages.search')" id="searchBookInput" />

                    </div>
                </div>
            </div>
            @foreach ($books as $book)
                <div class="col-lg-2 col-md-3 mb-4 book-1">
                    @if ($book->user_id == Auth()->user()?->id)
                        <form method="GET" action="{{ route('delete_book', $book->id) }}">
                            <button type="submit" class="btn-remove-template">
                                <i class="bx bx-x icon-remove-template"></i>
                            </button>
                        </form>
                    @endif
                    <div>
                        <a href="{{ route('show_book', base64_encode($book->id)) }}">
                            <img src="{{ asset('assets/img/book.png') }}" alt="" class="book">
                        </a>
                    </div>

                    <p>{{ $book->title }}
                        <br>{{ $book->user->name }}<br>
                        <a href="{{ $book->getFirstMediaUrl('library') }}" download class="btn btn-link download-link">
                            <i class="bx bx-download"></i>
                        </a>
                    </p>

                </div>
            @endforeach



            @role('admin')
                <div class="form-group file-upload col-md-12 Template">
                    <form action="{{ route('create_book') }}" method="GET" enctype="multipart/form-data">
                        @csrf
                        <button type="submit" class="btn_download_book">
                            <i class="fas fa-upload upload-icon-template"></i>
                            @lang('pages.upload_book')
                        </button>
                    </form>
                </div>
            @endrole
        </div>
    </div>
@endsection

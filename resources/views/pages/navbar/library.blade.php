@extends('master.app')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class=" col-lg-12 col-md-12 col-sm-12  search_book">

                <div class="form-news search-book">
                    <i class="fa fa-search" style="color: black"></i>
                    <input value="" type="text" class="form-control form-input search-book-1 " placeholder="" />

                </div>
            </div>
        </div>

        <div class="row text-center box-book mt-3">

            @foreach ($books as $book)
                <div class="col-lg-2 col-md-3 mb-4 book-1">
                    <div>
                        <img src="{{ asset('assets/img/book.png') }}" alt="" class="book">
                    </div>

                    <p>{{ $book->title }}
                        <br>{{ $book->user->name }}<br>
                        <a href="{{ $book->getFirstMediaUrl('library') }}" download class="btn btn-link download-link">
                            <i class="bx bx-download"></i>
                        </a>
                    </p>

                </div>
            @endforeach





            <div class="form-group file-upload col-md-12 Template">
                <form action="{{ route('download_book') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <label for="emiratesIdUpload">Upload book </label>
                    <input type="file" name="book" id="emiratesIdUpload" class="form-control-file" accept=".pdf,.doc,.docx" />

                    <button type="submit" class="btn_download_book"> <i class="fas fa-upload upload-icon"></i></button>
                    @error('book')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror

                </form>
            </div>

        </div>
    </div>
@endsection

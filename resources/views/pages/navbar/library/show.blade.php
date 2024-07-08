@extends('master.app')
@section('content')
    <div class="container-fluid Library-1">
        <div class="row ">
            <div class=" col-lg-12 col-md-12 col-sm-12  Library  ">
                <div class="row">
                    <h2>Library</h2>
                </div>

                <div class="container-fluid">
                    <div class="row ">
                        <div class=" col-md-4  mt-5  Library-part-1  ">
                            <img alt="" src="{{ asset('assets/img/book.png') }}">
                            <h2>{{ $book->title }}</h2>
                        </div>

                        <div class=" col-md-8  mt-5 Library-part-2   ">
                            <p class="description-book">
                                {{ $book->description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

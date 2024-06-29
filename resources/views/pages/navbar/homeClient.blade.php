@extends('master.app')
@section('content')
    <!-- home section starts  -->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <h2 class="text_4">Find The Right Lawyer</h2>
                    <div class="height">

                        <form action="{{ route('explore_lawyer') }}" method="GET">
                            <div class="form-news">
                                <i class="fa fa-search" style="color: black"></i>
                                <input value="{{ request('search') }}" name="search" type="text"
                                    class="form-control form-input" placeholder="Who are you looking for? Tax Lawyer?" />
                            </div>
                        </form>

                        <div class="col-md-12 link-home">
                            <a href="{{ route('explore_lawyer', ['available' => 1]) }}"> Lawyers Available 24/7</a>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 box-news-2 ">

                            <div class="box-Questions-1">
                                <p class="link-questions-1">General Questions</p>
                                <a href="{{ route('list_general_questions') }}"> <img
                                        src="{{ asset('assets/img/Full_Website_-_LAWYER_V1__2_-removebg-preview.png') }}"
                                        alt="" class="img_1" /></a>
                            </div>

                            <div class="box-Questions-1">
                                <p class="link-questions-1">Translation Company</p>
                                <a href="{{ route('explore_translation_company') }}"> <img src="{{ asset('assets/img/translation.png') }}" alt=""
                                        class="img_1" /></a>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 box-news-2 ">
                            <div class="box-Questions-1">
                                <p class="  link-questions-1">Lawyer Practioners</p>
                                <a href="{{ route('explore_lawyer') }}"> <img src="{{ asset('assets/img/translation.png') }}" alt=""
                                        class="img_1" /></a>
                            </div>

                            <div class="box-Questions-1">
                                <p class="link-questions-1">FAQ</p>
                                <a href="{{ route('list_frequently_question') }}"> <img src="{{ asset('assets/img/FAQ.png') }}" alt=""
                                        class="img_1" /></a>
                            </div>
                        </div>




                    </div>
                </div>


                <div class="col-lg-6 col-md-12 col-sm-12">
                    <h1 class="text_5">NEWS</h1>
                    <div class="box-news mt-3">
                        <img src="{{ asset('assets/img/Full_Website_-_LAWYER_V1__3_-removebg-preview.png') }}"
                            alt="" class="img-news" />
                        <div>
                            <div class="container">
                                <div class="row">
                                    @foreach ($news as $object)
                                        <div class="col-lg-8 news-item mb-4 p-2 border-bottom">
                                            <p class="news-text">{{ $object->news }}</p>

                                        </div>

                                        <div class="col-lg-4 news-item mb-4 p-2 border-bottom">
                                            @if ($object->getFirstMediaUrl('news'))
                                                <img src="{{ $object->getFirstMediaUrl('news') }}" alt="News Image"
                                                    class="img-fluid rounded img_news" />
                                            @endif


                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

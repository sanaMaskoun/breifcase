@extends('master.app')
@section('content')
    <!-- home section starts  -->

    <section class="home-home">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <h2 class="text_4">@lang('pages.find_lawyer')</h2>
                    <div class="height">

                        <form action="{{ route('explore_lawyer') }}" method="GET">
                            <div class="form-news">
                                <i class="fa fa-search" style="color: black"></i>
                                <input value="{{ request('search') }}" name="search" type="text"
                                    class="form-control form-input" placeholder="@lang('pages.who_looking_lawyer')" />
                            </div>
                        </form>

                        <div class="col-md-12 link-home">
                            <a href="{{ route('explore_lawyer', ['available' => 1]) }}"> @lang('pages.lawyer_available')</a>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 box-news-2 ">

                            <div class="box-Questions-1">
                                <a class="style-link-box" href="{{ route('home_general_questions') }}">
                                    link </a>
                                <p class="link-questions-1">@lang('pages.questions')</p>

                                <a href="{{ route('home_general_questions') }}"> <img
                                        src="{{ asset('assets/img/reply_general_question.png') }}" alt=""
                                        class="img_1" /></a>
                            </div>

                            <div class="box-Questions-1">
                                <a class="style-link-box" href="{{ route('explore_translation_company') }}">
                                    link </a>
                                <p class="link-questions-1">@lang('pages.companies')</p>

                                <a href="{{ route('explore_translation_company') }}"> <img
                                        src="{{ asset('assets/img/translation.png') }}" alt="" class="img_1" /></a>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 box-news-2 ">
                            <div class="box-Questions-1">
                                <a class="style-link-box" href="{{ route('explore_lawyer') }}">
                                    link
                                </a>
                                <p class="  link-questions-1">@lang('pages.lawyers')</p>

                                <a href="{{ route('explore_lawyer') }}"> <img
                                        src="{{ asset('assets/img/lawyer_icon.png') }}" alt=""
                                        class="img_1" /></a>
                            </div>

                            <div class="box-Questions-1">
                                <a class="style-link-box"href="{{ route('page_frequently_question') }}">
                                    link
                                </a>
                                <p class="link-questions-1">@lang('pages.FAQ')</p>
                                <a href="{{ route('page_frequently_question') }}"> <img
                                        src="{{ asset('assets/img/FAQ.png') }}" alt="" class="img_1" /></a>
                            </div>
                        </div>




                    </div>
                </div>


                <div class="col-lg-6 col-md-12 col-sm-12">
                    <h1 class="text_5">@lang('pages.news')</h1>
                    <div class="box-news mt-3">
                        <img src="{{ asset('assets/img/news.png') }}" alt="" class="img-news" />
                        <div>
                            <div class="container">
                                <div class="row">
                                    @foreach ($news as $object)
                                        <a class="link-show-news"
                                            href="{{ route('show_news', base64_encode($object->id)) }}">
                                            <div class="col-lg-8 news-item mb-4 p-2 border-bottom">
                                                <p class="news-text">{{ $object->title }}</p>
                                                <span>{{ $object->short_description }}</span>

                                            </div>

                                            <div class="col-lg-4 news-item mb-4 p-2 border-bottom">
                                                @if ($object->getFirstMediaUrl('news'))
                                                    <img src="{{ $object->getFirstMediaUrl('news') }}" alt="News Image"
                                                        class="img-fluid rounded img_news" />
                                                @endif
                                            </div>
                                        </a>
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

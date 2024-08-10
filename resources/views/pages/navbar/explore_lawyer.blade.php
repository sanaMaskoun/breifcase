@extends('master.app')
@section('content')
    <div class="box1 container">
        <div class="row filter-lawyer">
            <div class="sidebar explore_lawyer col-lg-4 col-md-3 col-sm-12">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <h2 class="text_explore_lawyer">@lang('pages.practieces')</h2>
                            @foreach ($practices as $practice)
                                <a href="#" class="practice-link" data-id="{{ $practice->id }}">{{ $practice->name }}</a>
                            @endforeach
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <h2 class="text_explore_lawyer">@lang('pages.languages')</h2>
                            @foreach ($languages as $language)
                                <a href="#" class="language-link"
                                    data-id="{{ $language->id }}">{{ $language->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="content explore_lawyer col-lg-8 col-md-9 col-sm-12">
                <div class="col-12">
                    <h2 class="text_explore_lawyer">@lang('pages.lawyers')</h2>
                    <div class="row" id="lawyer-list">
                        @foreach ($lawyers as $lawyer)
                            <div class="profile-card col-lg-2 col-md-6 col-sm-12"
                                data-encoded-id="{{ base64_encode($lawyer->id) }}">
                                <a class="style-link-box"
                                    href="{{ route('show_lawyer', base64_encode($lawyer->id)) }}">link

                                </a>
                                <a class="link-in-explore-page"
                                    href="{{ route('show_lawyer', base64_encode($lawyer->id)) }}">
                                    <img src="{{ $lawyer->getFirstMediaUrl('profile') }}" alt="Profile" />
                                    <p class="name-in-explore-page">{{ $lawyer->name }}</p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

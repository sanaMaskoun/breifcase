<header id="header">

    <nav class="navbar navbar-expand-lg navbar-light fixed-top d-flex align-items-center ">
        <a class="navbar-brand" href="{{ route('home_client') }}">
            <img src="{{ asset('assets/img/logo.png') }}" alt="logo" class="logo__img img-fluid" />
            <br />
            <span class="logo__name">The legal platform</span>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">

                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> @lang('pages.explore')
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('explore_lawyer') }}">@lang('pages.lawyers')</a>
                        <a class="dropdown-item" href="{{ route('explore_translation_company') }}">
                            @lang('pages.companies')
                        </a>
                    </div>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('library') }}">@lang('pages.library')</a>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-globe"></i> @lang('pages.Language')
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href={{ route('lang', 'en') }}>@lang('pages.english')</a>
                        <a class="dropdown-item" href={{ route('lang', 'ar') }}>@lang('pages.arabic')</a>
                    </div>
                </li>


                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('about') }}">@lang('pages.about_as')</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('login') }}">@lang('pages.sing_in')</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link act dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @lang('pages.join')
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('join_lawyer') }}">@lang('pages.lawyer')</a>
                        <a class="dropdown-item" href="{{ route('join_client') }}">@lang('pages.client')</a>
                        <a class="dropdown-item" href="{{ route('join_translation_company') }}">@lang('pages.company')</a>
                    </div>
                </li>

            </ul>
        </div>
    </nav>
</header>

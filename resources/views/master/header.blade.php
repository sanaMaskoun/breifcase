
<header id="header">

    <nav class="navbar navbar-expand-lg navbar-light fixed-top d-flex align-items-center my-5" style="height: 3.5rem">
        <a class="navbar-brand" href="{{ route('home') }}">
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
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Explore
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('explore_lawyer') }}">Lawyer</a>
                        <a class="dropdown-item" href="{{ route('explore_translation_company') }}">Translation
                            Company</a>
                    </div>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('library') }}">Library</a>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-globe"></i> Language
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">English</a>
                        <a class="dropdown-item" href="#">Arabic</a>
                    </div>
                </li>


                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('about') }}">About Us</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('login') }}">Sign in</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link act dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        join
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('join_lawyer') }}">lawyer</a>
                        <a class="dropdown-item" href="{{ route('join_client') }}">client</a>
                        <a class="dropdown-item" href="{{ route('join_translation_company') }}">Translation Company</a>
                    </div>
                </li>

            </ul>
        </div>
    </nav>
</header>

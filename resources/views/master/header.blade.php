
    <aside class="left-sidebar sidebar-dark" id="left-sidebar">
        <div id="sidebar" class="sidebar sidebar-with-footer">


            <!-- Aplication Brand -->
            <div class="app-brand">
                <a href="{{route('dashboard')}}">
                    <img src="images/logo.png" alt="Breifcase">
                    <span class="brand-name">Breifcase</span>
                </a>
            </div>


            <!-- begin sidebar scrollbar -->

            <div class="sidebar-left" data-simplebar style="height: 100%;">
                <!-- sidebar menu -->
                <ul class="nav sidebar-inner" id="sidebar-menu">



                    <li class="active">
                        <a class="sidenav-item-link" href="{{route('dashboard')}}">
                            <i class="mdi mdi-briefcase-account-outline"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a class="sidenav-item-link" href="analytics.html">
                            <i class="mdi mdi-chart-line"></i>
                            <span class="nav-text">Consultations</span>
                        </a>
                    </li>

                    <li>
                        <a class="sidenav-item-link" href="{{route('chat')}}">
                            <i class="mdi mdi-wechat"></i>
                            <span class="nav-text">Chat app</span>
                        </a>
                    </li>

                    <li>
                        <a class="sidenav-item-link" href="contacts.html">
                            <i class="mdi mdi-phone"></i>
                            <span class="nav-text">General Questions</span>
                        </a>
                    </li>

                </ul>

            </div>

        </div>
    </aside>



    <!-- ====================================
——— PAGE WRAPPER
===================================== -->
    <div class="page-wrapper">

        <!-- Header -->
        <header class="main-header" id="header">
            <nav class="navbar navbar-expand-lg navbar-light" id="navbar">


                <!-- Sidebar toggle button -->

                <button id="sidebar-toggler" class="sidebar-toggle">
                    <span class="sr-only">Toggle navigation</span>
                </button>

                <span class="page-title">dashboard</span>

                <div class="navbar-right ">

                    <!-- search form -->
                    <div class="search-form">
                        <form action="index.html" method="get">
                            <div class="input-group input-group-sm" id="input-group-search">
                                <input type="text" autocomplete="off" name="query" id="search-input"
                                    class="form-control" placeholder="Search..." />
                                <div class="input-group-append">
                                    <button class="btn" type="button">/</button>
                                </div>
                            </div>
                        </form>

                    </div>

                    <ul class="nav navbar-nav">
                        <!-- Offcanvas -->

                        <li class="custom-dropdown">
                            <button class="notify-toggler custom-dropdown-toggler">
                                <i class="mdi mdi-bell-outline icon"></i>
                                <span class="badge badge-xs rounded-circle">21</span>
                            </button>
                            <div class="dropdown-notify">

                                <header>
                                    <div class="nav nav-underline" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="all-tabs" data-toggle="tab"
                                            href="#all" role="tab" aria-controls="nav-home"
                                            aria-selected="true">All (5)</a>
                                    </div>
                                </header>

                                <div class="" data-simplebar style="height: 325px;">
                                    <div class="tab-content" id="myTabContent">

                                        <div class="tab-pane fade show active" id="all" role="tabpanel"
                                            aria-labelledby="all-tabs">

                                            <div class="media media-sm bg-warning-10 p-4 mb-0">
                                                <div class="media-sm-wrapper">
                                                    <a href="user-profile.html">
                                                        <img src="images/user/user-sm-02.jpg" alt="User Image">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <a href="user-profile.html">
                                                        <span class="title mb-0">John Doe</span>
                                                        <span class="discribe">Extremity sweetness difficult behaviour
                                                            he of. On disposal of as landlord horrible. Afraid at highly
                                                            months do things on at.</span>
                                                        <span class="time">
                                                            <time>Just now</time>...
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- User Account -->
                        <li class="dropdown user-menu">
                            <button class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <img src="images/user/user-xs-01.jpg" class="user-image rounded-circle"
                                    alt="User Image" />
                                <span class="d-none d-lg-inline-block">John Doe</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a class="dropdown-link-item" href="user-profile.html">
                                        <i class="mdi mdi-account-outline"></i>
                                        <span class="nav-text">My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-link-item" href="email-inbox.html">
                                        <i class="mdi mdi-email-outline"></i>
                                        <span class="nav-text">Message</span>
                                        <span class="badge badge-pill badge-primary">24</span>
                                    </a>
                                </li>

                                <li class="dropdown-footer">
                                    <a class="dropdown-link-item" href="sign-in.html"> <i class="mdi mdi-logout"></i>
                                        Log Out </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>


        </header>






    </div>

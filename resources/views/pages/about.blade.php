<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@lang('pages.about_as')</title>
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/aboutStyle.css') }}" />
    <style>
        :root {
            --background-url: url('{{ asset('assets/img/screen.webp') }}');
        }
    </style>
</head>

<body>
    <section class="container-about-1">
        <div class="container">
            <div class="overlay-1"></div>

            <div class="faq-header-1">
                <div class="row">
                    <div iv class="col-12">
                        <span class="lead-2">@lang('pages.first_title_about')</span>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="line-1"></div>
                            <div class="col-md-12">
                                <h1>@lang('pages.second_title_about')</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <span class="lead-3"> @lang('pages.third_title_about')</span>
                    </div>
                </div>

            </div>
            <div class="faq-content-1">
                <div class="row">
                    <div class="col-md-12">

                        <img src="{{ asset('assets/img/logo.png') }}" alt="Briefcase Icon" />
                    </div>
                    <div class="col-12">
                        <span class="lead-1">@lang('pages.title_logo')</span>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <section class="container-about-1 mt-5">
        <div class="container">
            <div class="overlay-1"></div>
            <div class="container contact-1">
                <div class="row">
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h2>@lang('pages.title_first_page_about')</h2>
                        <p>
                           @lang('pages.description_first_page_about')
                        </p>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-6">
                        <h4>@lang('pages.title_content_first_page_about')</h4>
                        <ul>
                            <li>@lang('pages.description1_content_first_page_about')</li>
                            <li>@lang('pages.description2_content_first_page_about')</li>
                            <li>@lang('pages.description3_content_first_page_about')</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul>
                            <li>@lang('pages.description4_content_first_page_about')</li>
                            <li>@lang('pages.description5_content_first_page_about')</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="container-about-1 mt-5">
        <div class="container">
            <div class="overlay-1"></div>
            <div class="container contact-About">

                <div class="container mt-5">
                    <div class="row contact-us-container">
                        <div class="col-auto">
                            <h1 class="font-weight-bold">@lang('pages.header_second_page_about')</h1>
                        </div>
                        <div class="col line"></div>
                    </div>
                </div>

                <div class="underline"></div>

                <div class="section-title">@lang('pages.title_content_second_page_about')</div>
                <div class="section-content">
                    @lang('pages.description_second_page_about')
                </div>

                <div class="section-title">@lang('pages.title_content_second_page_about')</div>
                <div class="section-content">
                    <ul>
                        <li>
                            @lang('pages.description1_content_second_page_about')
                        </li>
                        <li>
                            @lang('pages.description2_content_second_page_about')

                        </li>
                        <li>
                            @lang('pages.description3_content_second_page_about')

                        </li>
                        <li>
                            @lang('pages.description4_content_second_page_about')

                        </li>
                        <li>
                            @lang('pages.description5_content_second_page_about')

                        </li>
                        <li>
                            @lang('pages.description6_content_second_page_about')

                        </li>
                    </ul>
                </div>

                <div class="footer-1">
                    @lang('pages.footer_second_page')

                </div>
            </div>
        </div>

    </section>

    <section class="container-about-1 mt-5">
        <div class="container">
            <div class="overlay-1"></div>

            <div class="container features-section contact-About">

                <div class="container mt-5">
                    <div class="row">
                        <div class="col-12 future-plans-1">
                            <div class="line"></div>
                            <h1 class="text">@lang('pages.header_third_paage_about')</h1>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 feature">
                        <img src="{{ asset('assets/img/5.png') }}" alt="Innovative Technology">
                        <div>
                            <h5>@lang('pages.title1_third_page_about')</h5>
                            <p>@lang('pages.description1_third_page_about')</p>
                        </div>
                    </div>
                    <div class="col-md-6 feature">
                        <img src="{{ asset('assets/img/11aff9543afb235df5bc4a9bb82e8e49.png') }}" alt="User Experience">
                        <div>
                            <h5>@lang('pages.title2_third_page_about')</h5>
                            <p>@lang('pages.description2_third_page_about')</p>
                        </div>
                    </div>
                    <div class="col-md-6 feature">
                        <img src="{{ asset('assets/img/0466791484253327ee964873a3dc9834 (1).png') }}"
                            alt="Global Connectivity">
                        <div>
                            <h5>@lang('pages.title3_third_page_about')</h5>
                            <p>@lang('pages.description3_third_page_about')</p>
                        </div>
                    </div>
                    <div class="col-md-6 feature">
                        <img src="{{ asset('assets/img/078049782293c0f98213972de6558f1e.png') }}" alt="Accessibility"
                            style="width: 60px;">
                        <div>
                            <h5>@lang('pages.title4_third_page_about')</h5>
                            <p>@lang('pages.description4_third_page_about')</p>
                         </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>

    </section>

    <section class="container-about-1 mt-5">
        <div class="container">
            <div class="overlay-1"></div>


            <div class="container features-section contact-About">

                <div class="container mt-5">
                    <div class="row contact-us-container">
                        <div class="col-auto">
                            <h1 class="font-weight-bold">@lang('pages.header_third_paage_about')</h1>
                        </div>
                        <div class="col line"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 feature">
                        <img src="{{ asset('assets/img/6.png') }}" alt="Innovative Technology">
                        <div>
                            <h5>@lang('pages.title1_four_page_about')</h5>
                            <p>@lang('pages.description1_four_page_about')</p>
                        </div>
                    </div>
                    <div class="col-md-6 feature">
                        <img src="{{ asset('assets/img/7.png') }}" alt="User Experience">
                        <div>
                            <h5>@lang('pages.title2_four_page_about')</h5>
                            <p>@lang('pages.description2_four_page_about')</p>
                        </div>
                    </div>
                    <div class="col-md-6 feature">
                        <img src="{{ asset('assets/img/588b5c2352d3b89a22d0e16bec2b0e6e.png') }}"
                            alt="Global Connectivity">
                        <div>
                            <h5>@lang('pages.title3_four_page_about')</h5>
                            <p>@lang('pages.description3_four_page_about')</p>
                        </div>
                    </div>
                    <div class="col-md-6 feature">
                        <img src= "{{ asset('assets/img/6d521eb08e4ce4c4e5316c96d8e99ed3.png') }}" alt="Accessibility">
                        <div>
                            <h5>@lang('pages.title4_four_page_about')</h5>
                            <p>@lang('pages.description4_four_page_about')</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="container-about-1 mt-5">
        <div class="container">
            <div class="overlay-1"></div>


            <div class="container contact-About">
                <div class="future-plans mt-5">
                    <div class="container mt-5">
                        <div class="row">
                            <div class="col-12 future-plans-1">
                                <div class="line"></div>
                                <h1 class="text">@lang('pages.header_five_page_about')</h1>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title">@lang('pages.title1_five_page_about')</div>
                            <p>@lang('pages.first_description1_five_page_about')
                                <br> @lang('pages.second_description1_five_page_about')
                            </p>
                        </div>
                        <div class="col-md-12">
                            <div class="section-title">@lang('pages.title2_five_page_about')</div>
                            <p>@lang('pages.first_description2_five_page_about')
                                <br> @lang('pages.second_description2_five_page_about')
                            </p>
                        </div>
                    </div>
                    <div class="map">
                        <img src="{{ asset('assets/img/4a4b77f1768b243ae0d4373b065dab60.png') }}" alt="World Map">
                    </div>
                </div>
            </div>


        </div>

    </section>
    <section class="container-about-1 mt-5">
        <div class="container">
            <div class="overlay-1"></div>
            <div class="container text-center contact-About py-5">

                <div class="container mt-5">
                    <div class="row contact-us-container">
                        <div class="col-auto">
                            <h1 class="font-weight-bold">@lang('pages.header_six_page_about')</h1>
                        </div>
                        <div class="col line"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 text-column mt-5">


                        <p class="description">@lang('pages.info_six_page')</p>
                        <p class="email">Info@BriefcasePlatform.com</p>
                    </div>
                    <div class="col-md-6 image-column">
                        <img src="{{ asset('assets/img/8b497884ee8ae8c463ca736803dd9bcc.png') }}" alt="Email Icon"
                            class="email-icon">
                    </div>
                </div>
            </div>

        </div>

    </section>
    <section class="container-about-1 mt-5">
        <div class="container">
            <div class="overlay-1"></div>

            <div class="container contact-About">
                <div class="logo mt-5">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Briefcase Logo" class="logo-img img-fluid">

                </div>
                <div class="content-final">
                    <p>@lang('pages.final_page')
                    </p>
                    <h2 class="mt-5">@lang('pages.footer_final_page')</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <a href="{{ route('home_client') }}" class="footer-about"> <i class="bx bx-home"></i> </a>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="{{ asset('assets/js/index.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<!DOCTYPE html>
{{--  <html lang="en">  --}}
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FAQs</title>
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/FAQstyle.css') }}" />
    <style>
        :root {
            --background-url: url('{{ asset('assets/img/screen.webp') }}');
        }
    </style>
</head>

<body class="faq">
    <section class="container-about">
        <div class="container">
            <div class="overlay"></div>
            <div class="faq-header">
                <img src="{{ asset('img/faq_logo.png') }}" alt="Briefcase Icon" />
            </div>
            <div class="faq-content">
                <div class="row">
                    <div class="col-md-12">
                        <h2>@lang('pages.question1')</h2>
                        <p>
                            @lang('pages.answer1')
                        </p>
                    </div>
                    <div class="col-md-12">
                        <h2>@lang('pages.question2')</h2>
                        <p>
                            @lang('pages.answer2')
                        </p>
                    </div>
                    <div class="col-md-12">
                        <h2>@lang('pages.question3')</h2>
                        <p>
                            @lang('pages.answer3')
                        </p>
                    </div>
                    <div class="col-md-12">
                        <h2>@lang('pages.question4')</h2>
                        <p>
                            @lang('pages.answer4')
                        </p>
                    </div>
                </div>
            </div>
        </div>



    </section>
    <section class="container-about mt-3">
        <div class="container">
            <div class="overlay"></div>
            <div class="faq-header">
                <img src="{{ asset('img/faq_logo.png') }}" alt="Briefcase Icon" />
            </div>
            <div class="faq-content">
                <div class="row">
                    <div class="col-md-12">
                        <h2>@lang('pages.question5')</h2>
                        <p>
                            @lang('pages.answer5')
                        </p>
                    </div>
                    <div class="col-md-12">
                        <h2>@lang('pages.question6')</h2>
                        <p>
                            @lang('pages.answer6')
                        </p>
                    </div>
                    <div class="col-md-12">
                        <h2>@lang('pages.question7')</h2>
                        <p>
                            @lang('pages.answer7')
                        </p>
                    </div>
                    <div class="col-md-12">
                        <h2>@lang('pages.question8')</h2>
                        <p>
                            @lang('pages.answer8')
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="container-about mt-3">
        <div class="container">
            <div class="overlay"></div>
            <div class="faq-header">
                <img src="{{ asset('img/faq_logo.png') }}" alt="Briefcase Icon" />
            </div>
            <div class="faq-content">
                <div class="row">
                    <div class="col-md-12">
                        <h2>@lang('pages.question9')</h2>
                        <p>
                            @lang('pages.answer9')
                        </p>
                    </div>
                    <div class="col-md-12">
                        <h2>@lang('pages.question10')</h2>
                        <p>
                            @lang('pages.answer10')
                        </p>
                    </div>
                    <div class="col-md-12">
                        <h2>@lang('pages.question11')</h2>
                        <p>
                            @lang('pages.answer11')
                        </p>
                    </div>
                    <div class="col-md-12">
                        <h2>@lang('pages.question12')</h2>
                        <p>
                            @lang('pages.answer12')
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="container-about mt-3">
        <div class="container">
            <div class="overlay"></div>
            <div class="faq-header">
                <img src="{{ asset('img/faq_logo.png') }}" alt="Briefcase Icon" />
            </div>
            <div class="faq-content">
                <div class="row">
                    <div class="col-md-12">
                        <h2>@lang('pages.question13')</h2>
                        <p>
                            @lang('pages.answer13')
                        </p>

                    </div>
                    <div class="col-md-12">
                        <h2>@lang('pages.question14')</h2>
                        <p>
                            @lang('pages.answer14')
                        </p>
                    </div>
                    <div class="col-md-12">
                        <h2>@lang('pages.question15')</h2>
                        <p>
                            @lang('pages.answer15')
                        </p>
                    </div>
                    <div class="col-md-12">
                        <h2>@lang('pages.question16')</h2>
                        <p>
                            @lang('pages.answer16')
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="container-about mt-3">
        <div class="container">
            <div class="overlay"></div>
            <div class="faq-header">
                <img src="{{ asset('img/faq_logo.png') }}" alt="Briefcase Icon" />
            </div>
            <div class="faq-content">
                <div class="row">
                    <div class="col-md-12">
                        <h2>@lang('pages.question17')</h2>
                        <p>
                            @lang('pages.answer17')
                        </p>

                    </div>
                    <div class="col-md-12">
                        <h2>@lang('pages.question18')</h2>
                        <p>
                            @lang('pages.answer18')
                        </p>
                    </div>
                    <div class="col-md-12">
                        <h2>@lang('pages.question19')</h2>
                        <p>
                            @lang('pages.answer19')
                        </p>

                    </div>
                    <div class="col-md-12">
                        <h2>@lang('pages.question20')</h2>
                        <p>
                            @lang('pages.answer20')
                        </p>

                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="container-about mt-3">
        <div class="container">
            <div class="overlay"></div>
            <div class="faq-header">
                <img src="{{ asset('img/faq_logo.png') }}" alt="Briefcase Icon" />
            </div>
            <div class="faq-content">
                <div class="row">
                    <div class="col-md-12">
                        <h2>@lang('pages.question21')</h2>
                        <p>
                            @lang('pages.answer21')
                        </p>


                    </div>
                    <div class="col-md-12">
                        <h2>@lang('pages.question22')</h2>
                        <p>
                            @lang('pages.answer22')
                        </p>
                    </div>
                    <div class="col-md-12">
                        <h2>@lang('pages.question23')</h2>
                        <p>
                            @lang('pages.answer23')
                        </p>
                    </div>
                    <div class="col-md-12">
                        <h2>@lang('pages.question24')</h2>
                        <p>
                            @lang('pages.answer24')
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="container-about mt-3 paddfaq">
        <div class="container">
            <div class="overlay"></div>
            <div class="faq-header">
                <img src="{{ asset('img/faq_logo.png') }}" alt="Briefcase Icon" />
            </div>
            <div class="faq-content">
                <div class="row">
                    <div class="col-md-12">
                        <h2>@lang('pages.question25')</h2>
                        <p>
                            @lang('pages.answer25')
                        </p>

                    </div>
                    <div class="col-md-12">
                        <h2>@lang('pages.question26')</h2>
                        <p>
                            @lang('pages.answer26')
                        </p>
                    </div>
                    <div class="col-md-12">
                        <h2>@lang('pages.question27')</h2>
                        <p>
                            @lang('pages.answer27')
                        </p>
                    </div>

                    <div class="col-md-12">
                        <h2>@lang('pages.question28')</h2>
                        <p>
                            @lang('pages.answer28')
                        </p>

                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">

                    <a href="{{ route('home_client') }}" class="footer-about"> <i class="bx bx-home"></i></a>

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

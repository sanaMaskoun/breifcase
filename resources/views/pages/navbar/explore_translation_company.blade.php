@extends('master.app')
@section('content')
    <div class="box1">
        <div class="container continer_1">
            <div class="row">
                <div class="col-12 d-flex header_lang">

                    <div class="col-12">
                        <p class="language_company"> @lang('pages.languages')</p>
                    </div>


                    <div class="card-language col-12">
                        @foreach ($languages as $language)
                            <div class="col-lg-2 col-md-6 col-sm-6">
                                <div class="form-row">
                                    <div class="custom-control custom-checkbox col">
                                        <input type="checkbox" class="custom-control-input language-filter"
                                            id="language_{{ $language->id }}" style="display: none" data-id="{{ $language->id }}">
                                        <label class="custom-control-label"
                                            for="language_{{ $language->id }}">{{ $language->name }}</label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div id="company-list" class="row filter-translation-companies">
            @foreach ($translation_companies as $translation_company)
            <div class="col-lg-2 col-md-6 col-sm-4 card-company" data-encoded-id="{{ base64_encode($translation_company->id) }}">
                <div class="profile-card_1">
                    <a class="style-link-box"
                    href="{{ route('show_company', base64_encode($translation_company->id)) }}">link

                </a>
                        <a class="link-in-explore-page"
                            href="{{ route('show_company', base64_encode($translation_company->id)) }}">
                            <img src="{{ $translation_company->getFirstMediaUrl('profile') }}" alt="Profile" />
                            <p class="name-in-explore-page">{{ $translation_company->name }}</p>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

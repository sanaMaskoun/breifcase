@extends('master.app')
@section('content')
    <div class="box1">
        <div class="container continer_1">
            <div class="row">
                <div class="col-12 d-flex header_lang">

                    <div class="col-3">
                        <p class="language_company"> Language</p>
                    </div>

                    <div class="card-language col-9">
                        @foreach ($languages as $language)
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="form-row">
                                    <div class="custom-control custom-checkbox col">
                                        <input type="checkbox" class="custom-control-input language-filter"
                                            id="language_{{ $language->id }}" data-id="{{ $language->id }}">
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
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="profile-card_1">
                        <img src="{{ $translation_company->getFirstMediaUrl('profile') }}" alt="Profile" />
                        <p>{{ $translation_company->name }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

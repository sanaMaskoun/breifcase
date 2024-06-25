@extends('master.app')
@section('content')
    <div class="box1">
        <div class="container continer_1">
            <div class="row">
                <div class="col-12 d-flex header_lang">

                    <div class="col-3">
                        <a href="" class="btn1 mt-2">
                            Language</a>
                    </div>
                    <div class="card-language col-9">
                        @foreach ($languages as $language)
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="form-row">
                                    <div class="custom-control custom-checkbox col">
                                        <input type="checkbox" class="custom-control-input" id="arabic1">
                                        <label class="custom-control-label" for="arabic1">{{ $language->name }}</label>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
        @foreach ($translation_companies as $translation_company)
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="profile-card_1">
                    <img src="{{ $translation_company->getFirstMediaUrl('profile') }}" alt="Profile" />
                    <p>{{ $translation_company->name }}</p>
                </div>
            </div>
        @endforeach



    </div>
@endsection

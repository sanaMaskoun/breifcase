@extends('master.app')
@section('content')
    @php
        use App\Enums\UAECityEnum;
        use App\Enums\SaudiCityEnum;
        use App\Enums\CountryEnum;
        use Carbon\Carbon;

        if ($client->country == CountryEnum::Saudi) {
            $city = SaudiCityEnum::getKey($client->city);
        } elseif ($client->country == CountryEnum::UAE) {
            $city = UAECityEnum::getKey($client->city);
        }

        $client_encoded_id = base64_encode($client->id);

    @endphp
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12  ">
                <div class="box-profile chat-client-page">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-sm-12 ">
                            <img src="{{ $client->getFirstMediaUrl('profile') }}" alt="" class="img_3" />
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12 mt-3 ">
                            <h3>{{ $client->name }}</h3>
                            <span class="span"> {{ $client->gender == 1 ? __('EnumFile.male') : __('EnumFile.female') }} -
                                {{ $client->client->occupation }} - {{ __('EnumFile.' . $city) }}</span>
                        </div>
                        <div class="row row1 mt-3">
                            <div class="col-12 d-flex justify-content-center align-items-center mb-2">
                                <label for="name" class="me-2">@lang('pages.name')</label>
                                <div class="info_profile">
                                    {{ $client->name }}
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-center align-items-center mb-2">
                                <label for="email" class="me-2">@lang('pages.email'):</label>
                                <div class="info_profile">
                                    {{ $client->email }}
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-center align-items-center mb-2">
                                <label for="birth" class="me-2">@lang('pages.birth'):</label>
                                <div class="info_profile">
                                    {{ $client->birth }}
                                </div>
                            </div>
                            <form action="{{ route('edit_client', $client_encoded_id) }}" method="GET" class="form_edit">
                                <div class="col-12 mb-2 edit">
                                    <button type="submit"class="btn_edit_profile">@lang('pages.update_info') </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="box-profile">
                    <div class="container">
                        <div class="row d-flex">
                            <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                                <a href="{{ route('list_documents') }}" class="link-profile">

                                <img src="{{ asset('assets/img/Full_Website_-_CLIENT_V1__1_-removebg-preview.png') }}"
                                    alt="" class="img_4" />
                                </a>
                                <a href="{{ route('list_documents') }}" class="link-profile">@lang('pages.documents')</a>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                                <a href="{{ route('list_invoices') }}" class="link-profile">

                                <img src="{{ asset('assets/img/Full_Website_-_CLIENT_V1-removebg-preview.png') }}"
                                    alt="" class="img_4" /></a>
                                <a href="{{ route('list_invoices') }}" class="link-profile">
                                    @lang('pages.bills')</a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                                <a href="{{ route('list_general_questions', $client_encoded_id) }}"
                                class="link-profile">
                                <img src="{{ asset('assets/img/generalQuestion.png') }}" alt="" class="img_4" />
                                </a>
                                <a href="{{ route('list_general_questions', $client_encoded_id) }}"
                                    class="link-profile">
                                    @lang('pages.questions')</a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                                <a href="{{ route('chat_client') }}" class="link-profile">

                                <img src="{{ asset('assets/img/Full_Website_-_LAWYER_V1__7_-removebg-preview.png') }}"
                                    alt="" class="img_4" /></a>     
                                <a href="{{ route('chat_client') }}" class="link-profile">
                                    @lang('pages.chats')</a>
                            </div>
                        </div>
                    </div>
                </div>


                @yield('profile_content')

            </div>
        </div>
    </div>
@endsection

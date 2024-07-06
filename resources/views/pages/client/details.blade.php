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
            <div class="col-lg-4 col-md-6 col-sm-12 ">
                <div class="box-profile">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <img src="{{ $client->getFirstMediaUrl('profile') }}" alt="" class="img_3" />
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12 mt-3 ">
                            <h3>{{ $client->name }}</h3>
                            <span class="span">{{ $client->gender == 1 ? 'Male' : 'Female' }} -
                                {{ $client->client->occupation }} - {{ $city }}</span>
                        </div>
                        <div class="row row1 mt-3">
                            <div class="col-12 d-flex justify-content-center align-items-center mb-2">
                                <label for="name" class="me-2">Name:</label>
                                <div class="info_profile">
                                    {{ $client->name }}
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-center align-items-center mb-2">
                                <label for="email" class="me-2">Email:</label>
                                <div class="info_profile">
                                    {{ $client->email }}
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-center align-items-center mb-2">
                                <label for="birth" class="me-2">Date Birth:</label>
                                <div class="info_profile">
                                    {{ $client->birth }}
                                </div>
                            </div>
                            <form action="{{ route('edit_client' ,$client_encoded_id) }}" method="GET" class="form_edit">
                                <div class="col-12 mb-2 edit">
                                    <button type="submit"class="btn_edit_profile">Edit Info </button>
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
                                <img src="{{ asset('assets/img/Full_Website_-_CLIENT_V1__1_-removebg-preview.png') }}"
                                    alt="" class="img_4" />
                                <a href="{{ route('list_documents') }}" class="link-profile">Documents</a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                                <img src="{{ asset('assets/img/Full_Website_-_CLIENT_V1-removebg-preview.png') }}"
                                    alt="" class="img_4" />
                                <a href="{{ route('list_invoices') }}" class="link-profile">Bills</a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                                <img src="{{ asset('assets/img/generalQuestion.png') }}" alt=""
                                    class="img_4" />
                                <a href="{{ route('list_general_questions',$client_encoded_id) }}" class="link-profile">Questions</a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                                <img src="{{ asset('assets/img/Full_Website_-_LAWYER_V1__7_-removebg-preview.png') }}"
                                    alt="" class="img_4" />
                                <a href="{{ route('chat_client') }}" class="link-profile">Chat</a>
                            </div>
                        </div>
                    </div>
                </div>


                    @yield('profile_content')

            </div>
        </div>
    </div>
@endsection

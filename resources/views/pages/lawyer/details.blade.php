@extends('master.app')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            @if ($message = Session::get('success'))
                <div class="col-md-12">
                    <div class="alert alert-success" role="alert">
                        {{ $message }}
                    </div>
                </div>
            @endif

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Lawyer Details</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="about-info">
                                <h4>Profile

                                    <div class="uplod d-flex">
                                        <form method="GET" action="{{ route('edit_lawyer', $lawyer->id) }}">
                                            <label class="file-upload profile-upbtn mb-0">
                                                <button type="submit" class="btn"> <i
                                                        class="feather-edit-3"></i></button>
                                            </label>
                                        </form>
                                    </div>
                                </h4>

                            </div>
                            <div class="student-profile-head">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4">
                                        <div class="profile-user-box">
                                            <div class="profile-user-img">
                                                <img src="{{ asset($lawyer->getFirstMediaUrl('profileUser')) }}"
                                                    alt="Profile">



                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 d-flex align-items-center">
                                        <div class="follow-group">
                                            <div class="students-follows">
                                                <h5>No consultation</h5>
                                                <h4>2850</h4>
                                            </div>
                                            <div class="students-follows">
                                                <h5>No replies</h5>
                                                <h4>2850</h4>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 d-flex align-items-center">
                                        <form method="POST" action="{{ route('toggleStatus', $lawyer->id) }}">
                                            @csrf
                                            <label class="switch">
                                                <input type="checkbox" name="status" onchange="this.form.submit()"
                                                    {{ $lawyer->is_active ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="student-personals-grp">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="heading-detail">
                                            <h4>Personal Details :</h4>
                                        </div>

                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-user"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Name</h4>
                                                <h5>{{ $lawyer->name }}</h5>
                                            </div>
                                        </div>


                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-phone-call"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Mobile</h4>
                                                <h5>{{ $lawyer->phone }}</h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-mail"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Email</h4>
                                                <h5> {{ $lawyer->email }} </h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-user"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Gender</h4>
                                                <h5>{{ $lawyer->gender == 1 ? 'male' : 'fimale' }}</h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-calendar"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Date of Birth</h4>
                                                <h5>{{ $lawyer->birth }}</h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="fas fa-money-bill-alt"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>consultation price</h4>
                                                <h5>{{ $lawyer->consultation_price }}</h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            @if ($lawyer->is_active)
                                                <div class="personal-icons">
                                                    <i class="fas fa-check-circle"></i>
                                                </div>
                                                <div class="views-personal">
                                                    <h4>status</h4>
                                                    <h5> active </h5>
                                                </div>
                                            @else
                                                <div class="personal-icons">
                                                    <i class="fas fa-times-circle"></i>
                                                </div>
                                                <div class="views-personal">
                                                    <h4>status</h4>
                                                    <h5>non active </h5>
                                                </div>
                                            @endif

                                        </div>
                                        <div class="personal-activity ">
                                            <div class="personal-icons">
                                                <i class="feather-map-pin"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Location</h4>
                                                <h5>{{ $lawyer->location ? \App\Enums\LocationEnum::getDescription($lawyer->location) : 'Unknown' }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="fas fa-certificate"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>years of practice</h4>
                                                <h5>{{ $lawyer->years_of_practice }} years</h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity mb-0">
                                            <div class="personal-icons">
                                                <i class="far fa-clock"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Date of join</h4>
                                                <h5>{{ $lawyer->created_at->format('Y-m-d') }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="student-personals-grp">
                                <div class="card mb-0">
                                    <div class="card-body">
                                        <div class="heading-detail">
                                            <h4>certification :</h4>
                                        </div>
                                        <div class="hello-park">
                                            <div class="certificate">
                                                @foreach ($lawyer->getMedia('certification') as $certificate)
                                                    <img src="{{ asset($certificate->getUrl()) }}" alt="Certificate">
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="hello-park" style="margin-top: 1.5rem">
                                            <h4>practices :</h4>

                                            <div class="educate-year">
                                                <div class="follow-btn-group">
                                                    @foreach ($practices as $practice)
                                                        <button type="submit"
                                                            class="btn btn-info follow-btns">{{ $practice->name }}</button>
                                                    @endforeach

                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

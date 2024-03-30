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
                            <h3 class="page-title">Edit Lawyer Details</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('update_lawyer', $lawyer->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="about-info">
                                    <h4>Edit Profile </h4>
                                </div>
                                <div class="student-profile-head">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4">
                                            <div class="profile-user-box">
                                                <div class="profile-user-img">
                                                    <img src="{{ asset($lawyer->getFirstMediaUrl('profileUser')) }}"
                                                        alt="Profile">

                                                    <div class="form-group students-up-files profile-edit-icon mb-0">
                                                        <div class="uplod d-flex">
                                                            <label class="file-upload profile-upbtn mb-0">
                                                                <i class="feather-edit-3"></i><input type="file"
                                                                    name="profileUser">
                                                            </label>

                                                        </div>
                                                    </div>

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
                                                <h4>Edit Personal Details :</h4>
                                            </div>

                                            <div class="personal-activity">
                                                <div class="personal-icons">
                                                    <i class="feather-user"></i>
                                                </div>
                                                <div class="views-personal">
                                                    <div class="form-group local-forms">
                                                        <label>Name <span class="login-danger">*</span></label>
                                                        <input class="form-control" type="text" name="name"
                                                            value="{{ $lawyer->name }}">
                                                        @if ($errors->has('name'))
                                                            <span
                                                                class="errormsg text-danger">{{ $errors->first('name') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="personal-activity">
                                                <div class="personal-icons">
                                                    <i class="feather-phone-call"></i>
                                                </div>
                                                <div class="views-personal">
                                                    <div class="form-group local-forms">
                                                        <label>Mobile <span class="login-danger">*</span></label>
                                                        <input class="form-control" type="text" name="phone"
                                                            value="{{ $lawyer->phone }}">
                                                        @if ($errors->has('phone'))
                                                            <span
                                                                class="errormsg text-danger">{{ $errors->first('phone') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="personal-activity">
                                                <div class="personal-icons">
                                                    <i class="feather-mail"></i>
                                                </div>
                                                <div class="views-personal">
                                                    <div class="form-group local-forms">
                                                        <label> Email <span class="login-danger">*</span></label>
                                                        <input class="form-control" type="text" name="email"
                                                            value="{{ $lawyer->email }}">
                                                        @if ($errors->has('email'))
                                                            <span
                                                                class="errormsg text-danger">{{ $errors->first('email') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="personal-activity">
                                                <div class="personal-icons">
                                                    <i class="feather-user"></i>
                                                </div>
                                                <div class="views-personal">
                                                    <div class="form-group local-forms">
                                                        <label>gender<span class="login-danger">*</span></label>
                                                        <select class="form-control" name="gender">
                                                            <option value="1"
                                                                {{ $lawyer->gender == '1' ? 'selected' : '' }}>Male</option>
                                                            <option value="2"
                                                                {{ $lawyer->gender == '2' ? 'selected' : '' }}>Female
                                                            </option>
                                                        </select>

                                                        @if ($errors->has('gender'))
                                                            <span
                                                                class="errormsg text-danger">{{ $errors->first('gender') }}</span>
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="personal-activity">
                                                <div class="personal-icons">
                                                    <i class="feather-calendar"></i>
                                                </div>
                                                <div class="views-personal">
                                                    <div class="form-group local-forms">
                                                        <label> Date of Birth <span class="login-danger">*</span></label>
                                                        <input class="form-control" type="date" name="birth"
                                                            value="{{ $lawyer->birth }}">

                                                        @if ($errors->has('birth'))
                                                            <span
                                                                class="errormsg text-danger">{{ $errors->first('birth') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="personal-activity">
                                                <div class="personal-icons">
                                                    <i class="fas fa-money-bill-alt"></i>
                                                </div>

                                                <div class="views-personal">
                                                    <div class="form-group local-forms">
                                                        <label>consultation price <span
                                                                class="login-danger">*</span></label>
                                                        <input class="form-control" type="text"
                                                            name="consultation_price"
                                                            value="{{ $lawyer->consultation_price }}">
                                                        @if ($errors->has('consultation_price'))
                                                            <span
                                                                class="errormsg text-danger">{{ $errors->first('consultation_price') }}</span>
                                                        @endif
                                                    </div>
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

                                            <div class="personal-activity mb-0">
                                                <div class="personal-icons">
                                                    <i class="feather-map-pin"></i>
                                                </div>

                                                <div class="views-personal">
                                                    <div class="form-group local-forms">
                                                        <label>Location <span class="login-danger">*</span></label>
                                                        <select class="form-control" name="location">
                                                            <option value="1"
                                                                {{ $lawyer->location == 1 ? 'selected' : '' }}>Dubai
                                                            </option>
                                                            <option value="2"
                                                                {{ $lawyer->location == 2 ? 'selected' : '' }}>Abu Dhabi
                                                            </option>
                                                            <option value="3"
                                                                {{ $lawyer->location == 3 ? 'selected' : '' }}>Ajman
                                                            </option>
                                                            <option value="4"
                                                                {{ $lawyer->location == 4 ? 'selected' : '' }}>Ras Al
                                                                Khaimah
                                                            </option>
                                                            <option value="5"
                                                                {{ $lawyer->location == 5 ? 'selected' : '' }}>Fujairah
                                                            </option>
                                                            <option value="6"
                                                                {{ $lawyer->location == 6 ? 'selected' : '' }}>Umm
                                                                Al-Quwain
                                                            </option>
                                                            <option value="7"
                                                                {{ $lawyer->location == 7 ? 'selected' : '' }}>Al Ain
                                                            </option>
                                                        </select>
                                                        @if ($errors->has('location'))
                                                            <span
                                                                class="errormsg text-danger">{{ $errors->first('location') }}</span>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="personal-activity">
                                                <div class="personal-icons">
                                                    <i class="feather-user"></i>
                                                </div>
                                                <div class="views-personal">
                                                    <div class="form-group local-forms">
                                                        <label>years of practice <span
                                                                class="login-danger">*</span></label>
                                                        <input class="form-control" type="text"
                                                            name="years_of_practice"
                                                            value="{{ $lawyer->years_of_practice }}">
                                                        @if ($errors->has('years_of_practice'))
                                                            <span
                                                                class="errormsg text-danger">{{ $errors->first('years_of_practice') }}</span>
                                                        @endif
                                                    </div>
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
                                                <h4>certification</h4>
                                            </div>
                                            <div class="hello-park">
                                                <div class="certificate">
                                                    @foreach ($lawyer->getMedia('certification') as $certificate)
                                                        
                                                        <img src="{{ asset($certificate->getUrl()) }}" alt="Certificate">
                                                    @endforeach
                                                </div>
                                                <div class="mt-3">
                                                    <label for="file-upload" class="btn btn-primary">
                                                        <i class="fas fa-cloud-upload-alt"></i> Upload Certificate
                                                    </label>
                                                    <input id="file-upload" type="file" name="certification[]" multiple 
                                                        style="display: none;">
                                                    @if ($errors->has('certification'))
                                                        <span
                                                            class="errormsg text-danger">{{ $errors->first('certification') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="hello-park">
                                                <h4>practices</h4>

                                                <div class="educate-year">
                                                    <div class="follow-btn-group">
                                                        @foreach ($practices as $practice)
                                                            <label style="margin-left: 5rem;">
                                                                <input type="checkbox" name="practices[]"
                                                                    value="{{ $practice->id }}"
                                                                    {{ !is_null($lawyer->practices) && in_array($practice->id, $lawyer->practices->pluck('id')->toArray()) ? 'checked' : '' }} />
                                                                {{ $practice->name }}
                                                            </label>
                                                        @endforeach
                                                        @if ($errors->has('practices'))
                                                            <span
                                                                class="errormsg text-danger">{{ $errors->first('practices') }}</span>
                                                        @endif
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="student-submit">
                                <button type="submit" class="btn btn-primary">save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

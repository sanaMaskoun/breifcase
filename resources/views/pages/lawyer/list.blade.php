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
                            <h3 class="page-title">List Lawyers</h3>

                        </div>
                    </div>
                </div>
            </div>

            <form method="GET" action="{{ route('list_lawyers') }}">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <div class="input-group">
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Search here" value="{{ request('name') }}">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="location">Location:</label>
                            <select name="location" id="location" class="form-control">
                                <option value="">Choose location</option>
                                <option value="1" {{ request('location') == '1' ? 'selected' : '' }}>Dubai</option>
                                <option value="2" {{ request('location') == '2' ? 'selected' : '' }}>Abu Dhabi</option>
                                <option value="3" {{ request('location') == '3' ? 'selected' : '' }}>Ajman</option>
                                <option value="4" {{ request('location') == '4' ? 'selected' : '' }}>Ras Al Khaimah</option>
                                <option value="5" {{ request('location') == '5' ? 'selected' : '' }}>Fujairah</option>
                                <option value="6" {{ request('location') == '6' ? 'selected' : '' }}>Umm Al-Quwain</option>
                                <option value="7" {{ request('location') == '7' ? 'selected' : '' }}>Al Ain</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="practice">Practice:</label>
                            <div class="input-group">
                                <select name="practice" id="practice" class="form-control">
                                    <option value="">Choose practice</option>
                                    @foreach ($practices as $practice)
                                        <option value="{{ $practice->id }}"
                                            {{ request('practice') == $practice->id ? 'selected' : '' }}>
                                            {{ $practice->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>




            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table comman-shadow">
                        <div class="card-body pb-0">

                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">Lawyers</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="student-pro-list">
                                <div class="row">
                                    @foreach ($lawyers as $lawyer)
                                        <div class="col-xl-3 col-lg-4 col-md-6 d-flex">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="student-box flex-fill">
                                                        <div class="student-img">
                                                            <a href="{{ route('show_lawyer',$lawyer->id) }}">
                                                                <img class="img-fluid" alt="Students Info"
                                                                    src="{{ asset($lawyer->getFirstMediaUrl('profileUser')) }}">
                                                            </a>
                                                        </div>
                                                        <div class="student-content pb-0">
                                                            <h5><a href="{{ route('show_lawyer',$lawyer->id) }}">{{ $lawyer->name }}</a></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

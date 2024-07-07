@extends('pages.dashboard.sidebar')
@section('dashboard')
    <div class="col-lg-9 col-md-1">
        <div class="content">
            <h2>Translation companies</h2>
            <div class="container">
                <div class="row">
                    @foreach ($companies as $company)
                        <div class="col-md-3 lawyer-card mt-5">
                            <form method="POST" action="{{ route('toggle_status', base64_encode($company->id)) }}">
                                @csrf
                                <div class="toggle-switch">
                                    <div class="custom-switch">
                                        <input type="checkbox" id="toggle_{{ $company->id }}" name="status"
                                            onchange="this.form.submit()" {{ $company->is_active ? 'checked' : '' }}>

                                        <label for="toggle_{{ $company->id }}"></label>
                                    </div>
                                </div>
                            </form>
                            <a href="{{ route('details_company', base64_encode($company->id)) }}" class="title-template">
                                 <img  src="{{ $company->getFirstMediaUrl('profile') }}" alt="company 1">
                                <h5>{{ $company->name }}</h5>
                            </a>
                        </div>
                    @endforeach




                </div>
            </div>
        </div>




    </div>
@endsection

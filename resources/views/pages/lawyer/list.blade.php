@extends('pages.dashboard.sidebar')
@section('dashboard')
    {{--  <div class=" col-lg-7 col-md-8 col-sm-8  content-Admin mt-5">  --}}
    <div class="col-lg-9 col-md-1">
        <div class="content">
            <h2>lawyers</h2>
            <div class="container">
                <div class="row">
                    @foreach ($lawyers as $lawyer)
                        <div class="col-md-3 lawyer-card mt-5">
                            <form method="POST" action="{{ route('toggle_status', base64_encode($lawyer->id)) }}">
                                @csrf
                                <div class="toggle-switch">
                                    <div class="custom-switch">
                                        <input type="checkbox" id="toggle_{{ $lawyer->id }}" name="status"
                                            onchange="this.form.submit()" {{ $lawyer->is_active ? 'checked' : '' }}>

                                        <label for="toggle_{{ $lawyer->id }}"></label>
                                    </div>
                                </div>
                            </form>
                            <a href="{{ route('details_lawyer', base64_encode($lawyer->id)) }}" class="title-template">
                                 <img  src="{{ $lawyer->getFirstMediaUrl('profile') }}" alt="Lawyer 1">
                                <h5>{{ $lawyer->name }}</h5>
                            </a>
                        </div>
                    @endforeach




                </div>
            </div>
        </div>




    </div>
@endsection

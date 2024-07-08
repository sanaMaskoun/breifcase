@extends('pages.dashboard.sidebar')
@section('dashboard')
@php
    use App\Enums\UserTypeEnum;
@endphp
    <div class="col-lg-9 col-md-1">
        <div class="content">
            <h2>Users</h2>
            <div class="container">
                <div class="row">
                    @foreach ($users as $user)
                        <div class="col-md-3 lawyer-card mt-5">
                            <form method="POST" action="{{ route('toggle_status', base64_encode($user->id)) }}">
                                @csrf
                                <div class="toggle-switch">
                                    <div class="custom-switch">
                                        <input type="checkbox" id="toggle_{{ $user->id }}" name="status"
                                            onchange="this.form.submit()" {{ $user->is_active ? 'checked' : '' }}>

                                        <label for="toggle_{{ $user->id }}"></label>
                                    </div>
                                </div>
                            </form>
                            @if ($user->type == UserTypeEnum::lawyer)
                                <a href="{{ route('details_lawyer', base64_encode($user->id)) }}" class="title-template">
                                    <img src="{{ $user->getFirstMediaUrl('profile') }}" alt="user 1">
                                    <h5>{{ $user->name }}</h5>
                                </a>
                            @endif
                            @if ($user->type == UserTypeEnum::translation_company)
                                <a href="{{ route('details_company', base64_encode($user->id)) }}" class="title-template">
                                    <img src="{{ $user->getFirstMediaUrl('profile') }}" alt="user 1">
                                    <h5>{{ $user->name }}</h5>
                                </a>
                            @endif

                        </div>
                    @endforeach




                </div>
            </div>
        </div>




    </div>
@endsection

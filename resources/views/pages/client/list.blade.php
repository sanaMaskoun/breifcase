@extends('pages.dashboard.sidebar')
@section('dashboard')
    <div class="col-lg-9 col-md-1">
        <div class="content">
            <h2>Clients</h2>
            <div class="container">
                <div class="row">
                    @foreach ($clients as $client)
                        <div class="col-md-3 lawyer-card mt-5">
                            <form method="POST" action="{{ route('toggle_status', base64_encode($client->id)) }}">
                                @csrf
                                <div class="toggle-switch">
                                    <div class="custom-switch">
                                        <input type="checkbox" id="toggle_{{ $client->id }}" name="status"
                                            onchange="this.form.submit()" {{ $client->is_active ? 'checked' : '' }}>

                                        <label for="toggle_{{ $client->id }}"></label>
                                    </div>
                                </div>
                            </form>
                            <a href="{{ route('details_client', base64_encode($client->id)) }}" class="title-template">
                                 <img  src="{{ $client->getFirstMediaUrl('profile') }}" alt="client 1">
                                <h5>{{ $client->name }}</h5>
                            </a>
                        </div>
                    @endforeach




                </div>
            </div>
        </div>




    </div>
@endsection

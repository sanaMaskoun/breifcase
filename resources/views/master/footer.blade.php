@php
$client_encoded_id = base64_encode(Auth()->user()->id);

@endphp
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12" style="margin-top: 10px">

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

            <a href="#" class="footer" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bx bx-log-out" style="font-size: 25px"></i>Logout
            </a>

            <a href="{{ route('home') }}" class="footer">
                <i class="bx bx-home" style="font-size: 25px"></i>Home
            </a>

            <a href="{{ route('edit_client' , $client_encoded_id ) }}" class="footer"><i class="bx bx-cog" style="font-size: 25px"></i>Settings</a>
        </div>
    </div>
</div>

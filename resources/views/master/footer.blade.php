@php
    $client_encoded_id = base64_encode(Auth()->user()->id);

@endphp
<div class="container footer">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: 3px">

            {{--  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

            <a href="#" class="footer"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bx bx-log-out" style="font-size: 25px"></i>@lang('pages.logout')
            </a>

            @hasanyrole('client|admin')
                <a href="{{ route('home_client') }}" class="footer">
                    <i class="bx bx-home" style="font-size: 25px"></i>@lang('pages.home')
                </a>
            @endhasanyrole


            @role('lawyer')
                <a href="{{ route('home_lawyer') }}" class="footer">
                    <i class="bx bx-home" style="font-size: 25px"></i>@lang('pages.home')
                </a>
            @endrole
            @role('translation_company')
                <a href="{{ route('home_company') }}" class="footer">
                    <i class="bx bx-home" style="font-size: 25px"></i>@lang('pages.home')
                </a>
            @endrole

            @role('client')
                <a href="{{ route('edit_client', $client_encoded_id) }}" class="footer">
                    <i class="bx bx-cog" style="font-size: 25px"></i>
                    @lang('pages.settings')
                </a>
            @endrole  --}}
        </div>
    </div>
</div>

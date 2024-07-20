@extends('pages.client.show')

@section('profile_content')
    <div class="box-profile-1 ">
        <div class="details">

            @foreach ($invoices as $invoice)
                <div class="col-lg-4 col-md-6 col-sm-12 consultation-card">
                    <img src="{{ asset('assets/img/invoice.png') }}" alt="invoice Image" class="img-doc">
                    <div>
                        <p>title:<span>
                                {{ $invoice->consultation ? $invoice->consultation->title : $invoice->case->title }}</span>
                        </p>
                        <p>lawyer:<span>{{ $invoice->receiver->name }}</span> </p>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
@endsection

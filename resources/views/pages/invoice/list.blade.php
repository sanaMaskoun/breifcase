@extends('pages.client.show')

@section('profile_content')
    <div class="box-profile-1 ">
        <div class="search-status mt-2">
            <input value="{{ request('search') }}" name="search" type="text"
                class="form-control form-input input-search-status" id="statusSearch" placeholder="Enter status" />
        </div>
        <div class="details">

            @foreach ($invoices as $invoice)
                <div class="col-lg-4 col-md-6 col-sm-12 consultation-card bill-card">
                  <a href="{{ route('show_client_invoices',base64_encode($invoice->id)) }}">
                    <img src="{{ asset('assets/img/invoice.png') }}" alt="invoice Image" class="img-doc">
                  </a>
                    <p class="title-document-dashboard"> {{ $invoice->document->title }} </p>

                    <div class="container-details-document-dashboard">
                        <p class="details-document-dashboard"> {{ $invoice->receiver->name }}</p>
                        <p class="details-document-dashboard">{{ $invoice->created_at->format('Y/m/d') }}</p>
                        <div class="status-bills {{ strtolower($status_texts[$invoice->status]) }}">
                            {{ $status_texts[$invoice->status] }}
                        </div>
                    </div>


                </div>
            @endforeach
        </div>
    </div>
@endsection

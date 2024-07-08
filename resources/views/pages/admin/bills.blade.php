@extends('pages.dashboard.sidebar')
@section('dashboard')

    <div class="col-lg-9 col-md-1">
        <div class="content ">
            <div class="header-documents-dashboard">
                <h2>Bills and Receipts</h2>
                <span class="num-document">Total {{ $num_bills }} </span>

            </div>

            <div class="list-document-dashboard">
                @foreach ($bills as $bill)
                    <div class="col-lg-4 col-md-6 col-sm-12  mt-4 ">
                        <img src="{{ asset('assets/img/invoice.png') }}" alt="bills Image" class="img-doc">
                        <h5 class="title-document-dashboard">{{ $bill->document->title }}</h5>
                        <div class="container-details-document-dashboard">
                            <p class="details-document-dashboard">{{ $bill->sender->name }} to {{ $bill->receiver->name }}</p>
                            <p class="details-document-dashboard">{{ $bill->created_at->format('Y/m/d') }}</p>
                            <div class="status-bills {{ strtolower($status_texts[$bill->status]) }}">
                                {{ $status_texts[$bill->status] }}
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection

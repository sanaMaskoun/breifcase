@extends('pages.dashboard.sidebar')
@section('dashboard')
    {{--  <div class="col-lg-9 col-md-1">  --}}
    <div class="content bill-details-container">
        <div class="d-flex justify-content-between">
            <h2 class="bill-details-header">@lang('pages.bill_details')</h2>

            @php
                $statusText = strtolower($status_texts[$bill->status]);
            @endphp

            <div class="status-bills {{ $statusText }}">
                @lang('EnumFile.' . $statusText)
            </div>

        </div>

        <div class="bill-details">
            <p><span class="label">Invoice ID:</span> {{ $bill->invoiceId }}</p>
            <p><span class="label">Invoice Value:</span> {{ $bill->invoice_value }}</p>
            <p><span class="label">Sender:</span> {{ $bill->sender->name }}</p>
            <p><span class="label">Receiver:</span> {{ $bill->receiver->name }}</p>
            <p><span class="label">Document Title:</span> {{ $bill->document->title }}</p>
            <p><span class="label">Created At:</span> {{ $bill->created_at->format('Y/m/d') }}</p>

        </div>
    </div>
    {{--  </div>  --}}
@endsection

@extends('pages.dashboard.sidebar')
@section('dashboard')

<div class="col-lg-9 col-md-1">
    <div class="content bill-details-container">
        <div class="d-flex justify-content-between">
        <h2 class="bill-details-header">Bill Details</h2>
        <div class="status-bills {{ strtolower($status_texts[$bill->status]) }}">
            {{ $status_texts[$bill->status] }}
        </div>
    </div>
        <div class="bill-details">
            <p><span class="label">Invoice ID:</span> {{ $bill->invoiceId }}</p>
            <p><span class="label">Invoice Value:</span> {{$bill->invoice_value}}</p>
            <p><span class="label">Sender:</span> {{ $bill->sender->name }}</p>
            <p><span class="label">Receiver:</span> {{ $bill->receiver->name }}</p>
            <p><span class="label">Document Title:</span> {{ $bill->document->title }}</p>
            <p><span class="label">Created At:</span> {{ $bill->created_at->format('Y/m/d') }}</p>

        </div>
    </div>
</div>

@endsection

@extends('pages.client.show')

@section('profile_content')
<div class="col-lg-9 col-md-1">
    <div class="container box-profile-1">
        <div class="d-flex justify-content-between">
        <h2 class="bill-details-header">Bill Details</h2>
        <div class="status-bills {{ strtolower($status_texts[$invoice->status]) }}">
            {{ $status_texts[$invoice->status] }}
        </div>
    </div>
        <div class="bill-details">
            <p><span class="label">Invoice ID:</span> {{ $invoice->invoiceId }}</p>
            <p><span class="label">Invoice Value:</span> {{$invoice->invoice_value}}</p>
            <p><span class="label">Sender:</span> {{ $invoice->sender->name }}</p>
            <p><span class="label">Receiver:</span> {{ $invoice->receiver->name }}</p>
            <p><span class="label">Document Title:</span> {{ $invoice->document->title }}</p>
            <p><span class="label">Created At:</span> {{ $invoice->created_at->format('Y/m/d') }}</p>

        </div>
    </div>
</div>

@endsection

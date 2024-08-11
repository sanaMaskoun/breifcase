@extends('pages.client.show')

@section('profile_content')
    <div class="col-lg-9 col-md-1 invoice">
        <div class="container box-profile-1">
            <div class="d-flex justify-content-between">
                <h2 class="bill-details-header">@lang('pages.bill_details')</h2>
                <div class="status-bills {{ strtolower($status_texts[$invoice->status]) }}">
                    @lang('EnumFile.' . $status_texts[$invoice->status])
                </div>
            </div>
            <div class="bill-details">
                <p><span class="label">@lang('pages.invoice_id'):</span> {{ $invoice->invoiceId }}</p>
                <p><span class="label">@lang('pages.invoice_value'):</span> {{ $invoice->invoice_value }}</p>
                <p><span class="label">@lang('pages.sender'):</span> {{ $invoice->sender->name }}</p>
                <p><span class="label">@lang('pages.receiver'):</span> {{ $invoice->receiver->name }}</p>
                <p><span class="label">@lang('pages.document_title'):</span> {{ $invoice->document->title }}</p>
                <p><span class="label">@lang('pages.created_at'):</span> {{ $invoice->created_at->format('Y/m/d') }}</p>

            </div>
        </div>
    </div>
@endsection

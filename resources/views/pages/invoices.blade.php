@extends('master.app')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">



            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">@lang('pages.list_invoices')</h3>
                    </div>
                </div>
            </div>

            <form method="GET" action="{{ route('list_invoice') }}">
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">@lang('pages.status')</label>
                            <select name="status" id="status" class="form-control">
                                <option value=""></option>
                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>@lang('EnumFile.Accepte')</option>
                                <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>@lang('EnumFile.Pending')</option>
                                <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>@lang('EnumFile.Refund')</option>
                            </select>
                            <button class="btn btn_status" type="submit"><i class="fas fa-search"></i></button>

                        </div>
                    </div>

                </div>
            </form>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table comman-shadow">
                        <div class="card-body">

                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">@lang('pages.invoices')</h3>
                                    </div>

                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table border-0 star-student table-hover table-center mb-0  table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>@lang('pages.invoiceId')</th>
                                            <th>@lang('pages.titleConsultation')</th>
                                            <th>@lang('pages.sender')</th>
                                            <th>@lang('pages.receiver')</th>
                                            <th>@lang('pages.amount')</th>
                                            <th>@lang('pages.status')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoices as $invoice)
                                            @php
                                                $senderId = base64_encode($invoice->sender->id);
                                                $receiverId = base64_encode($invoice->receiver->id);
                                                $consultationId = base64_encode($invoice->consultation->id);
                                            @endphp
                                            <tr>
                                                <td>{{ $invoice->invoiceId }}</td>
                                                <td> <a href="{{ route('show_consultation', $consultationId) }}">
                                                        {{ $invoice->consultation->title }}
                                                    </a></td>
                                                <td> <a href="{{ route('show_client', $senderId) }}">
                                                        {{ $invoice->sender->name }}
                                                    </a></td>
                                                <td> <a href="{{ route('show_lawyer', $receiverId) }}">
                                                        {{ $invoice->receiver->name }}
                                                    </a></td>

                                                <td>{{ $invoice->invoice_value }}</td>
                                                <td>
                                                    @php
                                                    $statusDescription =   $invoice->status
                                                        ? \App\Enums\InvoiceStatusEnum::getDescription(
                                                            $invoice->status,
                                                        )
                                                        : 'pending';
                                                    $badgeColor =
                                                        $invoice->status == 1
                                                            ? 'bg-success'
                                                            : ($invoice->status == 2
                                                                ? 'bg-primary'
                                                                : 'bg-danger');
                                                @endphp
                                                <span class="badge {{ $badgeColor }}" style="color: black">@lang('EnumFile.'.$statusDescription)</span>

                                                   </td>


                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                                <div class="pagination">
                                    <span class="page-info">@lang('pagination.pages') {{ $invoices->currentPage() }}
                                        @lang('pagination.of')
                                        {{ $invoices->lastPage() }}</span>
                                    <a href="{{ $invoices->previousPageUrl() }}" class="prev"
                                        @if (!$invoices->previousPageUrl()) disabled @endif>@lang('pagination.previous')</a>
                                    <a href="{{ $invoices->nextPageUrl() }}" class="next"
                                        @if (!$invoices->nextPageUrl()) disabled @endif>@lang('pagination.next')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

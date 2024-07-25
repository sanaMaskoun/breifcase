<?php

namespace App\Http\Controllers;

use App\Enums\DocumentStatusEnum;
use App\Enums\InvoiceStatusEnum;
use App\Http\Requests\InvoiceRequest;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function bills_client(Request $request)
    {
        $client = Auth()->user();
        $invoices = Invoice::where('sender_id', Auth()->user()->id)->get();

        return view('pages.invoice.list', compact('invoices', 'client'));

    }

    public function bills_dashboard()
    {
        $bills = Invoice::where('receiver_id', Auth()->user()->id)->where('status' , InvoiceStatusEnum::accepte)->get();
        $num_bills = Invoice::where('receiver_id', Auth()->user()->id)->where('status' , InvoiceStatusEnum::accepte)->count();
        $status_texts = [
            InvoiceStatusEnum::pending => 'Pending',
            InvoiceStatusEnum::accepte => 'Accepte',
            InvoiceStatusEnum::refund => 'Refund',
        ];
        return view('pages.lawyer.bills' , compact('bills' ,'num_bills' ,'status_texts'));

    }
    public function bills_admin()
    {
        $bills = Invoice::all();
        $num_bills = Invoice::count();
        $status_texts = [
            InvoiceStatusEnum::pending => 'Pending',
            InvoiceStatusEnum::accepte => 'Accepte',
            InvoiceStatusEnum::refund => 'Refund',
        ];
        return view('pages.admin.bills.list' , compact('bills' ,'num_bills' ,'status_texts'));

    }


    public function show($bill_encode_id)
    {
        $bill = Invoice::find(base64_decode($bill_encode_id));
        $status_texts = [
            InvoiceStatusEnum::pending => 'Pending',
            InvoiceStatusEnum::accepte => 'Accepte',
            InvoiceStatusEnum::refund => 'Refund',
        ];
        return view('pages.admin.bills.show',compact('bill','status_texts'));
    }



    public function store(InvoiceRequest $request)
    {

        $invoice = Invoice::create($request->validated());
        return new InvoiceResource($invoice->load('sender', 'receiver', 'consultation', 'case'));
    }



}

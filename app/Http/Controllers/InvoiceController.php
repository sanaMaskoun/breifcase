<?php

namespace App\Http\Controllers;

use App\Enums\InvoiceStatusEnum;
use App\Http\Requests\InvoiceRequest;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function index(Request $request)
    {
        $client = Auth()->user();
        $invoices = Invoice::where('sender_id', Auth()->user()->id)->get();

        return view('pages.invoice.list', compact('invoices', 'client'));

    }

    public function bills_dashbord()
    {
        $bills = Invoice::where('receiver_id', Auth()->user()->id)->where('status' , InvoiceStatusEnum::accepte)->get();
        $num_bills = Invoice::where('receiver_id', Auth()->user()->id)->where('status' , InvoiceStatusEnum::accepte)->count();
        return view('pages.lawyer.bills' , compact('bills' ,'num_bills'));

    }
    public function store(InvoiceRequest $request)
    {

        $invoice = Invoice::create($request->validated());
        return new InvoiceResource($invoice->load('sender', 'receiver', 'consultation', 'case'));
    }



}

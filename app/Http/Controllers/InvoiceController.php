<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function index(Request $request)
    {
        $status = $request->query('status');

        $status == null ? $invoices = Invoice::paginate(PAGINATION_COUNT): $invoices = Invoice::where('status', $status)->paginate(PAGINATION_COUNT);


            return view('pages.invoices', compact('invoices'));

    }
    public function store(InvoiceRequest $request)
    {

        $invoice = Invoice::create($request->validated());
        return  new InvoiceResource($invoice->load('sender' , 'receiver' , 'consultation'));
    }
}

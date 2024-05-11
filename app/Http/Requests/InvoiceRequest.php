<?php

namespace App\Http\Requests;

use App\Enums\InvoiceStatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
           'invoiceId'              => ['required','unique:invoices,invoiceId'],
           'sender_id'              => ['required' ,'exists:users,id'],
           'receiver_id'            => ['required' ,'exists:users,id'],
           'consultation_id'        => ['required' ,'exists:consultations,id'],
           'invoice_value'          => ['required']
        ];
    }



    public function validated($key = null, $default = null)
    {
        return [
            'invoiceId'            => $this->invoiceId,
            'sender_id'            => $this->sender_id,
            'receiver_id'          => $this->receiver_id,
            'consultation_id'      => $this->consultation_id,
            'invoice_value'        => $this->invoice_value,
            'status'               =>  InvoiceStatusEnum::pending,

        ];
    }
}

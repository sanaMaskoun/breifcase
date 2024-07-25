<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcceptCaseRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'accept_case' => ['required', 'mimes:pdf,docx,doc,png,jpg,webp', 'max:6144'],

        ];
    }
}

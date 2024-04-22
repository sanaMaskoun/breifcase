<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'message' =>  ['nullable'],
            'attachments' => ['nullable','array','mimes:png,jpg,pdf,doc,docx,rar,zip,webp'],

        ];
    }

    public function validated($key = null, $default = null)
    {
        return [
           
        ];
    }
}

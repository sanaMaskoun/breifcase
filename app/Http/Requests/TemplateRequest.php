<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TemplateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'template' => ['required', 'mimes:pdf,docx,doc,png,jpg,webp', 'max:1024'],
        ];
    }

    public function validated($key = null, $default = null)
    {
        return [
            'user_id'  => Auth()->user()->id,

        ];
    }
}

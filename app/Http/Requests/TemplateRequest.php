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
            'title'   => ['required' ,'max:50'],
            'template' => ['required', 'mimes:pdf,docx,doc,png,jpg,webp', 'max:6144'],
        ];
    }

    public function validated($key = null, $default = null)
    {
        return [
            'title'     => $this->title,
            'user_id'  => Auth()->user()->id,

        ];
    }
}

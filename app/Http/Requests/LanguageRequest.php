<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LanguageRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

      public function rules(): array
    {
        $nameUnique = Rule::unique('languages', 'name')->ignore($this->language);

        return [
            'name'           => ['required','max:25', $nameUnique],
        ];
    }


    public function validated($key = null, $default = null)
    {
        return [
            'name'             => $this->name,

        ];

    }
}

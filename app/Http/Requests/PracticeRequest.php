<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PracticeRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        $nameUnique = Rule::unique('practices', 'name')->ignore($this->practice);

        return [
            'name'           => ['required','max:25', $nameUnique],
            'description'    => ['required','max:255']
        ];
    }


    public function validated($key = null, $default = null)
    {
        return [
            'name'             => $this->name,
            'description'      => $this->description,

        ];
    }
}

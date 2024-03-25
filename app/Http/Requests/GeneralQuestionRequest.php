<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneralQuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'question'             => ['required', 'max:255']
        ];
    }



    public function validated($key = null, $default = null)
    {
        return [
            'question'         => $this->question,
            'user_id'          => Auth()->user()->id
        ];
    }
}

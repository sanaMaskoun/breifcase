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
            'title'         => ['required','max:50'],
            'question'      => ['required', 'max:255']
        ];
    }



    public function validated($key = null, $default = null)
    {
        return [
            'title'            => $this->title,
            'question'         => $this->question,
            'sender_id'          => Auth()->user()->id
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LibraryRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'        => ['required','max:50'],
            'description'  => ['required' , 'max:255'],
            'book'         => ['required','mimes:pdf,doc,docx','max:10240'],

        ];
    }


    public function validated($key = null, $default = null)
    {
        return [
            'title'         => $this->title,
            'description'   => $this->description,
            'user_id'       => Auth()->user()->id,
        ];
    }
}

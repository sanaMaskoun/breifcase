<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
           'title'                   => ['required' , 'max:50'],
           'short_description'       => ['required' ],
           'description'             => ['required' ],
           'new'                     => ['nullable']
        ];
    }


    public function validated($key = null, $default = null)
    {
        return [
            'title'                   => $this->title,
            'short_description'       => $this->short_description,
            'description'             => $this->description,
            'user_id'                 => Auth()->user()->id
        ];
    }
}

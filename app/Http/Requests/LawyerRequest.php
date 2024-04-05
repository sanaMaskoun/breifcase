<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LawyerRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $emailUnique = Rule::unique('users', 'email')->ignore($this->lawyer);
        return [
            'name'                 => ['required', 'max:50'],
            'email'                => ['required', 'email', $emailUnique],
            'phone'                => ['required', 'numeric', 'digits_between:7,14'],
            'gender'               => ['required' ],
            'birth'                => ['required'],
            'location'             => ['required'],
            'years_of_practice'    => ['required','numeric'],
            'consultation_price'   => ['required','numeric'],
            'practices'            => ['required', 'array', 'exists:practices,id'],
            'profileUser'          => ['nullable', 'mimes:jpg,bmp,png'],
             'certification'       => ['nullable','array'],

        ];
    }



    public function validated($key = null, $default = null)
    {
        return [

            'name'                       => $this->name,
            'email'                      => $this->email,
            'phone'                      => $this->phone,
            'gender'                     => $this->gender,
            'birth'                      => $this->birth,
            'location'                   => $this->location,
            'consultation_price'         => $this->consultation_price,
            'years_of_practice'         => $this->years_of_practice,
        ];
    }
}

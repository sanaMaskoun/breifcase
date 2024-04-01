<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLawyerRequest extends FormRequest
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
        ];
    }


    public function validated($key = null, $default = null)
    {
        return [
 
            'name'              => $this->name,
            'email'             => $this->email,
            'is_active'         => true,
            
        ];
    }
}

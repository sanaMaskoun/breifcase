<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientUpdateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        $email_unique = Rule::unique('users', 'email')->ignore($this->client);

        return [
            'name'                   => ['required', 'max:50'],
            'email'                  => ['required', 'email', $email_unique],
            'birth'                  => ['required'],

        ];
    }


    public function validated($key = null, $default = null)
    {
        return [

            'name'        => $this->name,
            'email'       => $this->email,
            'birth'       => $this->birth,

        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name'          => ['required','max:30', ],
            'members'       => ['required','array','exists:users,id']
        ];
    }


    public function validated($key = null, $default = null)
    {
        return [
            'name'   => $this->name
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Enums\GroupTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class GeneralChatRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'          => ['required','max:30', ],
            'members'       => ['required_if:role,null','array','exists:users,id'],
            'role'          => ['required_if:members,null'],
        ];
    }


    public function validated($key = null, $default = null)
    {
        return [
            'name'   => $this->name,
            'type' => GroupTypeEnum::general_chat
        ];
    }
}

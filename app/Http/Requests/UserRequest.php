<?php

namespace App\Http\Requests;

use App\Enums\LocationEnum;
use App\Models\User;
use BenSampo\Enum\Rules\EnumKey;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // dd(request()->file('certification'));
        return [
            'name'                     => ['required', 'string', 'max:255'],
            'email'                    => ['required', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'phone'                    => ['required', 'numeric', 'digits_between:7,14'],
            'birth'                    => ['required'],
            'location'                 => ['required', Rule::in([LocationEnum::Dubai, LocationEnum::Abu_Dhabi, LocationEnum::Ajman, LocationEnum::rak, LocationEnum::Fujairah, LocationEnum::UM_ALQ, LocationEnum::al_ain])],
            'gender'                   => ['required', Rule::in([1, 2])],
            'consultation_price'       => ['required', 'numeric'],
            'profileUser'              => ['nullable', 'mimes:jpg,bmp,png'],
            'certification' => ['required', 'array', 'min:1'],
            'certification.*' => ['required', 'file', 'mimes:jpg,bmp,png,pdf'],


        ];
    }

    public function validated($key = null, $default = null)
    {
        return [

            'name'                       => $this->name,
            'email'                      => $this->email,
            'phone'                      => $this->phone,
            'birth'                      => $this->birth,
            'location'                   => $this->location,
            'gender'                     => $this->gender,
            'consultation_price'         => $this->consultation_price,
        ];
    }
}

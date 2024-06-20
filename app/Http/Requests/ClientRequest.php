<?php

namespace App\Http\Requests;

use App\Enums\CountryEnum;
use App\Enums\SaudiCityEnum;
use App\Enums\UAECityEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $emailUnique = Rule::unique('users', 'email')->ignore($this->user);
        return [
            'name'                   => ['required', 'max:50'],
            'email'                  => ['required', 'email', $emailUnique],
            'password'               => ['required', 'string', 'confirmed'],
            'password_confirmation'  => ['required', 'same:password'],
            'phone'                  => ['required', 'numeric', 'digits_between:7,14'],
            'gender'                 => ['required'],
            'birth'                  => ['required'],
            'country'                => ['required', Rule::in(CountryEnum::getValues())],
            'city'                   => ['required'],
            'emirates_id'            => ['required', 'numeric'],
            'front_emirates_id'      => ['required'],
            'back_emirates_id'       => ['required'],
            'profile'                => ['nullable', 'mimes:jpg,bmp,png'],
            'occupation'             => ['required'],

        ];
    }
    protected function withValidator($validator)
    {
        $validator->sometimes('city', ['required', Rule::in(SaudiCityEnum::getValues())], function ($input) {
            return $input->country === CountryEnum::Saudi;
        });

        $validator->sometimes('city', ['required', Rule::in(UAECityEnum::getValues())], function ($input) {
            return $input->country === CountryEnum::UAE;
        });
    }

    public function userValidated($key = null, $default = null)
    {
        return [

            'name'        => $this->name,
            'email'       => $this->email,
            'password'    => bcrypt($this->password),
            'phone'       => $this->phone,
            'gender'      => $this->gender,
            'birth'       => $this->birth,
            'country'     => $this->country,
            'city'        => $this->city,
            'emirates_id' => $this->emirates_id,
            'is_active'   => true
        ];
    }
    public function clientValidated($key = null, $default = null)
    {
        return [

            'occupation' => $this->occupation,
        ];
    }
}

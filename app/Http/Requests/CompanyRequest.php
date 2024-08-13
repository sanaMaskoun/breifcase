<?php

namespace App\Http\Requests;

use App\Enums\CountryEnum;
use App\Enums\SaudiCityEnum;
use App\Enums\UAECityEnum;
use App\Enums\UserTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        $emailUnique = Rule::unique('users', 'email')->ignore($this->user);
        return [
            'name'                 => ['required', 'max:50'],
            'email'                => ['required', 'email', $emailUnique],
            'password'             => ['required', 'string', 'confirmed'],
            'password_confirmation'=> ['required', 'same:password'],
            'phone'                => ['required', 'numeric', 'digits_between:7,14'],

            'country'              => ['required', Rule::in(CountryEnum::getValues())],
            'city'                 => ['required'],
            'facebook' => ['nullable'],
            'tiktok' => ['nullable'],

            'profile'              => ['nullable', 'mimes:jpg,bmp,png'],
            'languages'            => ['required', 'array' , 'exists:languages,id'],


            'translation_price'    => ['required','numeric'],
            'land_line'            => ['required', 'numeric'],
            'location'             => ['required'],
            'bio'                  => ['required', 'max:250'],
            'available'            => ['nullable'],
            'certifications'       => ['required', 'array'],
            'licenses'             => ['required', 'array'],



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

            'name'                       => $this->name,
            'email'                      => $this->email,
            'password'                   => bcrypt($this->password),
            'phone'                      => $this->phone,
            'country'                    => $this->country,
            'city'                       => $this->city,
            'type'                       => UserTypeEnum::translation_company,
            'is_active'                  => false,
        ];
    }
    public function companyValidated($key = null, $default = null)
    {
        return [

            'land_line'                => $this->land_line,
            'consultation_price'       => $this->translation_price,
            'location'                 => $this->location,
            'facebook'                 => $this->facebook,
            'tiktok'                 => $this->tiktok,
            'bio'                      => $this->bio,
            'available'                => $this->available == null ? false : true,
           ];
    }
}

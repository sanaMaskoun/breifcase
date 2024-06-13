<?php

namespace App\Http\Requests;

use App\Enums\CountryEnum;
use App\Enums\SaudiCityEnum;
use App\Enums\UAECityEnum;
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
        $emailUnique = Rule::unique('users', 'email')->ignore($this->user);
        return [
            'name'                 => ['required', 'max:50'],
            'email'                => ['required', 'email', $emailUnique],
            'password'             => ['required', 'string', 'confirmed'],
            'password_confirmation'=> ['required', 'same:password'],
            'phone'                => ['required', 'numeric', 'digits_between:7,14'],
            'gender'               => ['required' ],
            'birth'                => ['required'],
            'country'              => ['required', Rule::in(CountryEnum::getValues())],
            'city'                 => ['required'],
            'emirates_id'          => ['required', 'numeric'],
            'front_emirates_id'    => ['required'],
            'back_emirates_id'     => ['required'],
            'profile'              => ['nullable', 'mimes:jpg,bmp,png'],
            'practices'            => ['required', 'array', 'exists:practices,id'],
            'languages'            => ['required', 'array' , 'exists:languages,id'],


            'consultation_price'   => ['required','numeric'],
            'land_line'            => ['required', 'numeric'],
            'location'             => ['required'],
            'bio'                  => ['required', 'max:250'],
            'years_of_practice'    => ['required','numeric'],
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
            'gender'                     => $this->gender,
            'birth'                      => $this->birth,
            'country'                    => $this->country,
            'city'                       => $this->city,
            'emirates_id'                => $this->emirates_id,
        ];
    }
    public function lawyerValidated($key = null, $default = null)
    {
        return [

            'land_line'                => $this->land_line,
            'consultation_price'       => $this->consultation_price,
            'location'                 => $this->location,
            'bio'                      => $this->bio,
            'years_of_practice'        => $this->years_of_practice,
            'available'                => $this->available,
           ];
    }
}

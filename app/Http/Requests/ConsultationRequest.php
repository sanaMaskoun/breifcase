<?php

namespace App\Http\Requests;

use App\Enums\ConsultationStatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class ConsultationRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'title'        => ['required','max:50'],
            'description'  => ['required' , 'max:255']
        ];
    }


    public function validated($key = null, $default = null)
    {
        return [
            'title'               => $this->title,
            'description'         => $this->description,
            'sender_id'           => Auth()->user()->id,
            'receiver_id'         => $this->receiver->id,
            'status'              => ConsultationStatusEnum::pending
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'communication'               => ['required', Rule::in([1, 2, 3, 4, 5])],
            'response_time'               => ['required', Rule::in([1, 2, 3, 4, 5])],
            'problem_solving'             => ['required', Rule::in([1, 2, 3, 4, 5])],
            'understanding'               => ['required', Rule::in([1, 2, 3, 4, 5])],
            'comment'                     => ['required', 'max:255'],
        ];
    }


    public function validated($key = null, $default = null)
    {
        return [
            'communication'             => $this->communication,
            'response_time'             => $this->response_time,
            'problem_solving'           => $this->problem_solving,
            'understanding'             => $this->understanding,
            'comment'                   => $this->comment,
            'client_id'                 => $this->consultation->sender_id,
            'employee_id'               => $this->consultation->receiver_id,
            'consultation_id'           => $this->consultation->id

        ];
    }
}

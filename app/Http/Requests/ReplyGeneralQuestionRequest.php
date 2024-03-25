<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ReplyGeneralQuestionRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'reply'      => ['required', 'max:255'],
        ];
    }

    public function validated($key = null, $default = null)
    {
        return [
            'reply'                 => $this->reply,
            'user_id'               => Auth()->user()->id,
            'general_question_id'   => $this->general_question->id
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Enums\DocumentStatusEnum;
use App\Enums\DocumentTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class SendRequestToCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'title'        => ['required','max:50'],
            'description'  => ['required' , 'max:255'],
            'upload_document' => ['required']
        ];
    }


    public function validated($key = null, $default = null)
    {
        return [
            'title'               => $this->title,
            'description'         => $this->description,
            'sender_id'           => Auth()->user()->id,
            'receiver_id'         => base64_decode($this->company_encoded_id),
            'status'              => DocumentStatusEnum::pending,
            'type'                => DocumentTypeEnum::translate
        ];
    }
}

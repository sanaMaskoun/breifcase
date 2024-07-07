<?php

namespace App\Http\Requests;

use App\Enums\DocumentStatusEnum;
use App\Enums\DocumentTypeEnum;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CaseRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'title'        => ['required','max:50'],
            'description'  => ['required' , 'max:255'],
            'price'        => ['required','numeric'],
        ];
    }

    public function validated($key = null, $default = null)
    {
        $receiver_encode_id = $this->route('receiver_encode_id');
        $receiver_decode_id = base64_decode($receiver_encode_id);
        $receiver = User::find($receiver_decode_id);

        return array_merge(parent::validated(), [
            'title'                => $this->title,
            'description'          => $this->description,
            'price'                => $this->price,
            'sender_id'            => auth()->user()->id,
            'receiver_id'          => $receiver ? $receiver->id : null,
            'status'               => DocumentStatusEnum::pending,
            'type'                 => DocumentTypeEnum::case
        ]);

    }
}

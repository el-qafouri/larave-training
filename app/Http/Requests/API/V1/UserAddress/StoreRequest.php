<?php

namespace App\Http\Requests\API\V1\UserAddress;

use App\Models\Address;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique(app(Address::class)->getTable(), 'name')
                    ->where('user_id', $this->user()->id),
            ],
            'address' => ['required', 'string'],
            'receiver_name' => ['required', 'string'],
        ];
    }
}

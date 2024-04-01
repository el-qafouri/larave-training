<?php

namespace App\Http\Requests\API\V1\UserAddress;

use App\Models\Address;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        $addressId = $this->route('address');

        return app(Address::class)
            ->whereId($addressId)
            ->where('user_id', $this->user()->id)
            ->exists();
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique(app(Address::class)->getTable(), 'name')
                    ->ignore($this->user()->id, 'user_id'),
            ],
            'address' => ['required', 'string'],
            'receiver_name' => ['required', 'string'],
        ];
    }
}

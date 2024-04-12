<?php

namespace App\Http\Requests\API\V1\UserAddress;

use App\Models\Address;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{
    public function authorize(): bool
    {

        return app(Address::class)
            ->whereId($this->route('address'))
            ->where('user_id', $this->user()->id)
            ->exists();
    }

    public function rules(): array
    {
        return [

        ];
    }
}

<?php

namespace App\Http\Requests\API\V1\Auth;

use App\Rules\MobileAndPhoneValid;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'mobile' => ['required', 'string', new MobileAndPhoneValid()],
        ];
    }
}

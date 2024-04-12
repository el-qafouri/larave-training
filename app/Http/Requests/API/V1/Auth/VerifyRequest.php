<?php

namespace App\Http\Requests\API\V1\Auth;

use App\Rules\MobileAndPhoneValid;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VerifyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'mobile' => ['required', 'string', new MobileAndPhoneValid(), Rule::exists('users', 'mobile')],
            'code' => ['required', 'string'],
        ];
    }
}

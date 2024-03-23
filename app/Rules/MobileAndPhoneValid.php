<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MobileAndPhoneValid implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $value = ltrim($value, '0');
        if (! preg_match('/[1-9][0-9]{9}/', $value) > 0 || \strlen($value) !== 10) {
            $fail('validation.mobile')->translate();
        }
    }
}

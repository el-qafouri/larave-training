<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'bail|required|min:3|max:99',
            'email' => 'bail|required|email|unique:users',
            'password' => 'bail|required|min:4|max:99|confirmed'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'please enter your name',
            'name.min' => 'your name should be more than 3',
            'name.max' => 'your name should be less than 99',
            'email.required' => 'please enter your email',
            'email.email' => 'email format is not true',
            'email.unique'=>'your email is exist, please enter unique email',
            'password.required' => 'please enter your password',
            'password.min'=>'password should be more than 4',
            'password.max'=>'password should be less than 99',
            'password.confirmed'=>'password not confirmed'
        ];
    }
}

<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules() : array
    {
        return [
            'username' => ['required', 'unique:registered_users', 'max:255'],
            'phonenumber' => ['required', 'phone:INTERNATIONAL', 'unique:registered_users']
        ];
    }

    public function messages(): array
    {
        return [
            'phonenumber.phone' => 'The phone number field must be a valid number.'
        ];
    }
}

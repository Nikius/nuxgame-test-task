<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegenerateRequest extends FormRequest
{
    public function rules() : array
    {
        return [
            'uuid' => ['required', 'uuid', 'exists:user_auth_tokens'],
        ];
    }
}

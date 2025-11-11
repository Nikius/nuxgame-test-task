<?php

namespace App\Http\Requests\Game;

use Illuminate\Foundation\Http\FormRequest;

class HistoryRequest extends FormRequest
{
    public function rules() : array
    {
        return [
            'uuid' => ['required', 'uuid', 'exists:user_auth_tokens'],
        ];
    }
}

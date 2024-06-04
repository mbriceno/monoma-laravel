<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class LoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            'username' => 'required|exists:users',
            'password' => [
                'required',
                Password::min(6)->mixedCase()->numbers()->symbols(),
            ],
        ];
    }
}

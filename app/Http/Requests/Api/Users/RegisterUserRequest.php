<?php

namespace App\Http\Requests\Api\Users;

use App\Http\Requests\Api\ApiRequests;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends ApiRequests
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'numeric', 'min:4', 'confirmed'],
            'password_confirmation' => ['required', 'numeric', 'min:4'],
        ];
    }
}

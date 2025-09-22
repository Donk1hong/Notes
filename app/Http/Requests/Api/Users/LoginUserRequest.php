<?php

namespace App\Http\Requests\Api\Users;

use App\Http\Requests\Api\ApiRequests;
use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends ApiRequests
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:4'],
        ];
    }
}

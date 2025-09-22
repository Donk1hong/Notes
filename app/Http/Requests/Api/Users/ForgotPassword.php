<?php

namespace App\Http\Requests\Api\Users;

use App\Http\Requests\Api\ApiRequests;
use Illuminate\Foundation\Http\FormRequest;

class ForgotPassword extends ApiRequests
{

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
        ];
    }
}

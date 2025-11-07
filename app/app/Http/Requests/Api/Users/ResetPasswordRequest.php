<?php

namespace App\Http\Requests\Api\Users;

use App\Http\Requests\Api\ApiRequests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ResetPasswordRequest extends ApiRequests
{

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:users,email'],
            'token' => ['required'],
            'password' => ['required', 'min:6', 'confirmed'],
        ];
    }

    public function messages(): array {
        return [
            'password.min' => 'Пароль должен быть не короче 6 символов.',
            'email.exists' => 'Такого пользователя не существует.'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'errors' => $validator->errors(),
            ], 422)
        );
    }
}

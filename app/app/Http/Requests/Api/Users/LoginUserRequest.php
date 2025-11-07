<?php

namespace App\Http\Requests\Api\Users;

use App\Http\Requests\Api\ApiRequests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginUserRequest extends ApiRequests
{

    public function authorize(): bool {
        return true;
    }
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'min:6'],
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

<?php

namespace App\Http\Requests\Api\Users;

use App\Http\Requests\Api\ApiRequests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterUserRequest extends ApiRequests
{

    public function authorize(): bool {
        return true;
    }
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
            'password_confirmation' => ['required', 'min:6'],
        ];
    }

    public function messages(): array {
        return [
            'email.unique' => 'Такой email уже существует.',
            'password.min' => 'Пароль должен быть не короче 6 символов.',
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

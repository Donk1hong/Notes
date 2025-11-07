<?php

namespace App\Http\Requests\Api\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Password;

class EditUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'password' => ['required', 'confirmed', 'min:6', 'confirmed'],
            'password_confirmation' => ['required', 'min:6'],
        ];
    }

    public function messages(): array {
        return [
            'password.min' => 'Пароль должен быть не короче 6 символов.',
            'password_confirmation.min' => 'Пароль должен быть не короче 6 символов.'
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

<?php

namespace App\Http\Requests\Api\Notes;

use App\Http\Requests\Api\ApiRequests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateNoteRequest extends ApiRequests
{
    public function rules(): array
    {
        return [
            'title' => ['string', 'max:100'],
            'category' => ['string'],
            'description' => ['string', 'max:355'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'errors' => $validator->errors(),
            ])
        );
    }
}

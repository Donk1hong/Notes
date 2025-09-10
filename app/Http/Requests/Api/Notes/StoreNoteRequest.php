<?php

namespace App\Http\Requests\Api\Notes;

use App\Http\Requests\Api\ApiRequests;
use Illuminate\Foundation\Http\FormRequest;

class StoreNoteRequest extends ApiRequests
{

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:100'],
            'category' => ['string'],
            'description' => ['required', 'string', 'max:355'],
        ];
    }
}

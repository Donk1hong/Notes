<?php

namespace App\Http\Requests\Api\Notes;

use App\Http\Requests\Api\ApiRequests;
use Illuminate\Foundation\Http\FormRequest;

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
}

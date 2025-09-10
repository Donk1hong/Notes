<?php

namespace App\Http\Resources\Notes;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MinifiedNotesResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'category' => $this->category,
            'creation_date' => $this->created_at,
            'update_date' => $this->updated_at
        ];
    }
}

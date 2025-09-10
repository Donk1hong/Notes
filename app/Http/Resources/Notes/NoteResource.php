<?php

namespace App\Http\Resources\Notes;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'user_id' => $this->user_id,
            'category' => $this->category,
            'description' => $this->description,
            'created_data' => $this->created_at,
            'updated_data' => $this->updated_at,
        ];
    }
}

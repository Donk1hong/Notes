<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'category', 'description'];

    protected function title(): Attribute {
        return Attribute::make(
            get: fn ($value) => mb_ucfirst($value)
        );
    }

    protected function category(): Attribute {
        return Attribute::make(
            get: fn ($value) => mb_convert_case($value, MB_CASE_TITLE, "UTF-8"),
            set: fn ($value) => mb_convert_case($value, MB_CASE_TITLE, "UTF-8")
        );
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }
}

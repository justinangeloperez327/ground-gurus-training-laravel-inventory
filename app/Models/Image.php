<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    use HasFactory;

    protected $appends = [
        'image_url',
    ];

    protected $fillable = [
        'url',
    ];

    public function getImageUrlAttribute()
    {
        return $this->url ? asset('storage/' . $this->url) : null;
    }

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}

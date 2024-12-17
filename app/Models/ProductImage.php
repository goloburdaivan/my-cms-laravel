<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    protected $fillable = [
        'product_id',
        'image',
    ];

    public function getUrlAttribute(): string
    {
        return Storage::url($this->image);
    }
}

<?php

namespace App\Models;

use App\Contracts\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model implements Filterable
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'slug',
        'category_id',
        'article',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, 'product_attributes');
    }

    public function filters(): array
    {
        return [
            'name' => ['operator' => 'like', 'query_field' => 'name'],
            'article' => ['operator' => '=', 'query_field' => 'article'],
            'category_id' => ['operator' => '=', 'query_field' => 'category.id'],
        ];
    }

}

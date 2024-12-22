<?php

namespace App\Models;

use App\Contracts\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model implements Filterable
{
    protected $fillable = [
        'name',
        'parent_id',
        'published',
        'sort',
        'image',
    ];

    public function parent(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function filters(): array
    {
        return [
            'name' => ['operator' => 'like', 'query_field' => 'name'],
            'parent_id' => ['operator' => '=', 'query_field' => 'parent_id'],
        ];
    }
}

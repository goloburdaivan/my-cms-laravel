<?php

namespace App\Models;

use App\Contracts\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model implements Filterable
{
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'address',
        'email',
        'status',
        'total_price',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function filters(): array
    {
        return [
            'name' => ['operator' => 'like', 'query_field' => 'name'],
            'status' => ['operator' => '=', 'query_field' => 'status'],
            'phone' => ['operator' => '=', 'query_field' => 'phone'],
            'email' => ['operator' => '=', 'query_field' => 'email'],
            'address' => ['operator' => 'like', 'query_field' => 'address'],
        ];
    }
}

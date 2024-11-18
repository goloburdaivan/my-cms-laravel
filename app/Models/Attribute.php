<?php

namespace App\Models;

use App\Contracts\Filterable;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model implements Filterable
{
    protected $fillable = [
        'name',
        'value'
    ];

    public function filters(): array
    {
        return [
            'name' => ['operator' => 'like', 'query_field' => 'name'],
        ];
    }
}

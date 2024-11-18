<?php

namespace App\Repository;

use App\Models\Attribute;

class AttributeRepository extends AbstractRepository
{

    public function model(): string
    {
        return Attribute::class;
    }
}

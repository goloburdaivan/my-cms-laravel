<?php

namespace App\Repository;

use App\Models\Category;

class CategoryRepository extends AbstractRepository
{

    public function model(): string
    {
        return Category::class;
    }
}

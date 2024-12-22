<?php

namespace App\Repository;

use App\Models\Page;

class PageRepository extends AbstractRepository
{
    public function model(): string
    {
        return Page::class;
    }
}

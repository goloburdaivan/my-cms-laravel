<?php

namespace App\Repository;

use App\Models\Admin;

class AdminRepository extends AbstractRepository
{
    public function model(): string
    {
        return Admin::class;
    }
}

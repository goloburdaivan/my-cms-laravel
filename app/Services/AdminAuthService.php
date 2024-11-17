<?php

namespace App\Services;

use App\Repository\AdminRepository;

class AdminAuthService extends AbstractAuthService
{
    public function __construct(
        private readonly AdminRepository $repository
    ) {
        parent::__construct($repository);
    }

    public function guard(): string
    {
        return 'admin';
    }
}

<?php

namespace App\Services;

use App\Repository\UserRepository;

class UserAuthService extends AbstractAuthService
{
    public function __construct(
        private readonly UserRepository $repository,
    ) {
        parent::__construct($repository);
    }

    public function guard(): string
    {
        return 'web';
    }
}

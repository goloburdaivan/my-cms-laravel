<?php

namespace App\Services;

use App\DTO\CredentialsDTO;
use App\Repository\AbstractRepository;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

abstract class AbstractAuthService
{
    public function __construct(
        private readonly AbstractRepository $repository,
    ) {
    }

    abstract public function guard(): string;

    public function login(CredentialsDTO $credentials): bool
    {
        return Auth::guard($this->guard())->attempt([
            'email' => $credentials->email,
            'password' => $credentials->password
        ]);
    }

    public function logout(): void
    {
        Auth::guard($this->guard())->logout();
    }

    public function register(array $userData): Authenticatable
    {
        return $this->repository->create($userData);
    }
}

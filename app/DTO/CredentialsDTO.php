<?php

namespace App\DTO;

class CredentialsDTO
{
    public function __construct(
        public string $email,
        public string $password
    ) {
    }
}

<?php

namespace App\Http\Requests\Traits;

use App\DTO\CredentialsDTO;

trait CredentialsDTOConvertable
{
    public function toCredentials(): CredentialsDTO
    {
        return new CredentialsDTO(
            $this->input('email'),
            $this->input('password')
        );
    }
}

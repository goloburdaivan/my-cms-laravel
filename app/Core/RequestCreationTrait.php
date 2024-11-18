<?php

namespace App\Core;

trait RequestCreationTrait
{
    protected string $request;
    protected ?string $createRequest = null;
    protected ?string $updateRequest = null;

    protected function createRequest(): string
    {
        return $this->createRequest ?: $this->request;
    }

    protected function updateRequest(): string
    {
        return $this->updateRequest ?: $this->request;
    }
}

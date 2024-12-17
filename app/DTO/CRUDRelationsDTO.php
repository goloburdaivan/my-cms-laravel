<?php

namespace App\DTO;

class CRUDRelationsDTO
{
    public function __construct(
        public array $index = [],
        public array $show = [],
        public array $edit = [],
    ) {
    }
}

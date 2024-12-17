<?php

namespace App\Enums\Admin;

enum OrderStatus: string
{
    case PROCESSING = 'Processing';
    case PAID = 'Paid';

    public static function getList(): array
    {
        return [
            self::PROCESSING->name => self::PROCESSING->value,
            self::PAID->name => self::PAID->value,
        ];
    }
}

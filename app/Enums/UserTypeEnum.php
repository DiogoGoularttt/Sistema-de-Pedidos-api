<?php

namespace App\Enums;

enum UserTypeEnum: string
{
    case ADMIN = 'admin';
    case CLIENT = 'client';

    public static function toArray(): array
    {
        return [
            self::ADMIN->value => 'Admin',
            self::CLIENT->value => 'Client',
        ];
    }
}

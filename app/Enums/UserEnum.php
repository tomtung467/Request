<?php

namespace App\Enums;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
enum UserEnum : int
{
    case ADMIN = 0;
    case MANAGER = 1;
    case EMPLOYEE = 2;

    public function isAdmin(): bool
    {
        return $this === self::ADMIN;
    }

    public function isEmployee(): bool
    {
        return $this === self::EMPLOYEE;
    }

    public function isManager(): bool
    {
        return $this === self::MANAGER;
    }
}


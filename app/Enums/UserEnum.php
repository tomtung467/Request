<?php declare(strict_types=1);

namespace App\Enums;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
enum UserEnum : string
{
    case ADMIN = 'admin';
    case USER = 'user';
    case MANAGER = 'manager';
    case EMPLOYEE = 'employee';

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

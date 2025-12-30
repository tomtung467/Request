<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class UserEnum extends Enum
{
    const ADMIN = 'admin';
    const USER = 'user';
    const MANAGER = 'manager';
    const EMPLOYEE = 'employee';
    public function isAdmin(): bool
    {
        return $this->value === self::ADMIN;
    }
    public function isEmployee(): bool
    {
        return $this->value === self::EMPLOYEE;
    }
    public function isManager(): bool
    {
        return $this->value === self::MANAGER;
    }
}

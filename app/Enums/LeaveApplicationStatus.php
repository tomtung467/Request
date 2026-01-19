<?php declare(strict_types=1);

namespace App\Enums;

enum LeaveApplicationStatus: int
{
    case ACCEPTED = 0;
    case REJECTED = 1;
    case PENDING = 2;
    case CANCELLED = 3;

    public function isPending(): bool
    {
        return $this === self::PENDING;
    }
}

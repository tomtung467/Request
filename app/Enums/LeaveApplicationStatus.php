<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class LeaveApplicationStatus extends Enum
{
    const  accepted = 'accepted';
    const  rejected = 'rejected';
    const  pending = 'pending';
    const  cancelled = 'cancelled';
}

<?php declare(strict_types=1);

namespace App\Enums;


/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */

enum LeaveApplicationType: string
{
    case SICK = 'sick';
    case ANNUAL = 'annual';
    case UNPAID = 'unpaid';
}

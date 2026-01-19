<?php

namespace App\Enums;


/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */

enum LeaveApplicationType: int
{
    case SICK = 0;
    case ANNUAL = 1;
    case UNPAID = 2;
}

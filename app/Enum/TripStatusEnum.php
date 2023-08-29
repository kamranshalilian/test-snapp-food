<?php

namespace App\Enum;

use App\Enum\ManageEnum\EnumToArray;

enum TripStatusEnum
{
    use EnumToArray;
    case ASSIGNED;
    case AT_VENDOR;
    case DELIVERED;
    case PICKED;
}

<?php

namespace App\Enum;

use App\Enum\ManageEnum\EnumToArray;

enum TripStatusEnum: string
{
    use EnumToArray;

    case ASSIGNED = "ASSIGNED";
    case AT_VENDOR = "AT_VENDOR";
    case DELIVERED = "DELIVERED";
    case PICKED = "PICKED";
}

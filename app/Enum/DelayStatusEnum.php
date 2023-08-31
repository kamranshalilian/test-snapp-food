<?php

namespace App\Enum;

use App\Enum\ManageEnum\EnumToArray;

enum DelayStatusEnum: string
{
    use EnumToArray;

    case ASSIGNED = "ASSIGNED";

    case PENDING = "PENDING";

    case DONE = "DONE";

}

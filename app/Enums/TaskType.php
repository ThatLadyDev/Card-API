<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum TaskType: int
{
    use EnumTrait;

    case card_switch = 1;
}

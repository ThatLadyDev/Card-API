<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum TaskAction: int
{
    use EnumTrait;

    case mark_as_finished = 1;
    case mark_as_failed = 2;
}

<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum TaskStatusEnum: string
{
    use EnumTrait;

    case ToDo = 'todo';
    case InProgress = 'in_progress';
    case Done = 'done';
}

<?php

namespace App\Enums;

enum OperationTypeEnum: string
{
    case Single = 'Single';
    case Joint = 'Joint';
    case Any = 'Any';
}

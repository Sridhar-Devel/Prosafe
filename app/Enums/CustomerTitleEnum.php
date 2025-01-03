<?php

namespace App\Enums;

enum CustomerTitleEnum: string
{
    case Mr = 'Mr';
    case Ms = 'Ms';
    case Mrs = 'Mrs';
    case Dr = 'Dr';
    case Other = 'Other';
}

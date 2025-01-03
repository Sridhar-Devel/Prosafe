<?php

namespace App\Enums;

enum NomineeRelationEnum: string
{
    case Parent = 'Parent';
    case Guardian = 'Guardian';
    case Spouse = 'Spouse';
    case Child = 'Child';
    case Sibling = 'Sibling';
    case Other = 'Other';
}

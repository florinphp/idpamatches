<?php

namespace App\Enums;

enum IdpaLevelType: string
{
    case LEVEL_0 = 'Classifier';
    case LEVEL_1 = 'Level 1';
    case LEVEL_2 = 'Level 2';
    case LEVEL_3 = 'Level 3';
    case LEVEL_4 = 'Level 4';
    case LEVEL_5 = 'Level 5';

    public static function getAllValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}

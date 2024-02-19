<?php

namespace App\Enums;

enum TierType: string
{
    case TIER_1 = 'Tier 1';
    case TIER_2 = 'Tier 2';
    case TIER_3 = 'Tier 3';
    case TIER_4 = 'Tier 4';
    case TIER_5 = 'Tier 5';

    public static function getAllValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}

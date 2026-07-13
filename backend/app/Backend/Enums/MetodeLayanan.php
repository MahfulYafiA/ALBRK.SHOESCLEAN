<?php

namespace App\Backend\Enums;

enum MetodeLayanan: string
{
    case CUCI = 'cuci';
    case REPAIR = 'repair';
    case deep_clean = 'deep_clean';
    case UNYELLOWING = 'unyellowing';

    public function label(): string
    {
        return match($this) {
            self::CUCI => 'Cuci',
            self::REPAIR => 'Perbaikan',
            self::deep_clean => 'Deep Clean',
            self::UNYELLOWING => 'Unyellowing',
        };
    }
}

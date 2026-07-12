<?php

namespace App\Enums;

enum StatusReservasi: string
{
    case Diajukan = 'Diajukan';
    case Diproses = 'Diproses';
    case Selesai = 'Selesai';
    case Dibatalkan = 'Dibatalkan';

    /**
     * Get all values as array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get label for display
     */
    public function label(): string
    {
        return match($this) {
            self::Diajukan => 'Diajukan',
            self::Diproses => 'Diproses',
            self::Selesai => 'Selesai',
            self::Dibatalkan => 'Dibatalkan',
        };
    }
}

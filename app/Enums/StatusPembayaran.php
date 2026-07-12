<?php

namespace App\Enums;

enum StatusPembayaran: string
{
    case Lunas = 'Lunas';
    case BelumLunas = 'Belum Lunas';

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
            self::Lunas => 'Lunas',
            self::BelumLunas => 'Belum Lunas',
        };
    }
}

<?php

namespace App\Enums;

enum MetodeLayanan: string
{
    case Dropoff = 'Drop-off';
    case Pickup = 'Pick-up';

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
            self::Dropoff => 'Drop-off',
            self::Pickup => 'Pick-up',
        };
    }
}

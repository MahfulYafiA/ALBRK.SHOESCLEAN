<?php

namespace App\Enums;

enum UserRole: int
{
    case Superadmin = 1;
    case Admin = 2;
    case Pelanggan = 3;

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
            self::Superadmin => 'Superadmin',
            self::Admin => 'Admin',
            self::Pelanggan => 'Pelanggan',
        };
    }

    /**
     * Check if role is admin or above
     */
    public function isAdmin(): bool
    {
        return $this === self::Superadmin || $this === self::Admin;
    }

    /**
     * Check if role is superadmin
     */
    public function isSuperadmin(): bool
    {
        return $this === self::Superadmin;
    }

    /**
     * Check if role is customer
     */
    public function isPelanggan(): bool
    {
        return $this === self::Pelanggan;
    }
}

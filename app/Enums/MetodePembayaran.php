<?php

namespace App\Enums;

enum MetodePembayaran: string
{
    case Tunai = 'Tunai';
    case PaymentGateway = 'Payment Gateway';
    case BayarDiToko = 'Bayar di Toko';
    case BayarDiKasir = 'Bayar di Kasir';
    case COD = 'COD';

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
            self::Tunai => 'Tunai',
            self::PaymentGateway => 'Payment Gateway',
            self::BayarDiToko => 'Bayar di Toko',
            self::BayarDiKasir => 'Bayar di Kasir',
            self::COD => 'COD',
        };
    }

    /**
     * Check if payment method uses midtrans
     */
    public function isPaymentGateway(): bool
    {
        return $this === self::PaymentGateway;
    }

    /**
     * Convert string to enum (for database values)
     */
    public static function fromString(string $value): ?self
    {
        foreach (self::cases() as $case) {
            if ($case->value === $value) {
                return $case;
            }
        }
        return null;
    }
}

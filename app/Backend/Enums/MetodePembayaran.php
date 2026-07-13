<?php

namespace App\Backend\Enums;

enum MetodePembayaran: string
{
    case CASH = 'cash';
    case TRANSFER = 'transfer';
    case MIDTRANS = 'midtrans';

    public function label(): string
    {
        return match($this) {
            self::CASH => 'Cash',
            self::TRANSFER => 'Transfer',
            self::MIDTRANS => 'Payment Gateway',
        };
    }
}

<?php

namespace App\Backend\Enums;

enum StatusPembayaran: string
{
    case MENUNGGU = 'menunggu';
    case LUNAS = 'lunas';
    case GAGAL = 'gagal';
    case DIKEMBALIKAN = 'dikembalikan';

    public function label(): string
    {
        return match($this) {
            self::MENUNGGU => 'Menunggu',
            self::LUNAS => 'Lunas',
            self::GAGAL => 'Gagal',
            self::DIKEMBALIKAN => 'Dikembalikan',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::MENUNGGU => 'yellow',
            self::LUNAS => 'green',
            self::GAGAL => 'red',
            self::DIKEMBALIKAN => 'gray',
        };
    }
}

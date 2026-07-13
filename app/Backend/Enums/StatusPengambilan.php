<?php

namespace App\Backend\Enums;

enum StatusPengambilan: string
{
    case PERLU_DIAMBIL = 'perlu_diambil';
    case SUDAH_DIAMBIL = 'sudah_diambil';
    case DIANTAR = 'diantar';

    public function label(): string
    {
        return match($this) {
            self::PERLU_DIAMBIL => 'Perlu Diambil',
            self::SUDAH_DIAMBIL => 'Sudah Diambil',
            self::DIANTAR => 'Diantar',
        };
    }
}

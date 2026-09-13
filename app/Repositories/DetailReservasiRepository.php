<?php

namespace App\Repositories;

use App\Models\DetailReservasi;
use App\Repositories\Contracts\DetailReservasiRepositoryInterface;

class DetailReservasiRepository implements DetailReservasiRepositoryInterface
{
    public function create(array $data): DetailReservasi
    {
        return DetailReservasi::create($data);
    }
}

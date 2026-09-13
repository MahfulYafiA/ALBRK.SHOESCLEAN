<?php

namespace App\Repositories\Contracts;

use App\Models\DetailReservasi;

interface DetailReservasiRepositoryInterface
{
    public function create(array $data): DetailReservasi;
}

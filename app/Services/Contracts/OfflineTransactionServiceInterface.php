<?php

namespace App\Services\Contracts;

interface OfflineTransactionServiceInterface
{
    /** Create a paid, offline reservation and its detail atomically. */
    public function create(int $userId, array $data): array;
}

<?php

namespace App\Repositories\Contracts;

use App\Models\Pembayaran;
use App\Models\Reservasi;
use Illuminate\Database\Eloquent\Collection;

interface PembayaranRepositoryInterface
{
    /**
     * Find pembayaran by ID
     */
    public function findById(int $id): ?Pembayaran;

    /**
     * Find pembayaran by reservasi ID
     */
    public function findByReservasiId(int $reservasiId): ?Pembayaran;

    /**
     * Create new pembayaran
     */
    public function create(array $data): Pembayaran;

    /**
     * Update pembayaran
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete pembayaran
     */
    public function delete(int $id): bool;

    /**
     * Delete pembayaran by reservasi ID
     */
    public function deleteByReservasiId(int $reservasiId): bool;

    /**
     * Get all pembayaran with relations
     */
    public function getAllWithRelations(): Collection;

    /**
     * Get pembayaran by date range
     */
    public function getByDateRange(string $startDate, string $endDate): Collection;

    /**
     * Create or update pembayaran for reservasi
     */
    public function upsertByReservasi(Reservasi $reservasi, array $data): Pembayaran;
}

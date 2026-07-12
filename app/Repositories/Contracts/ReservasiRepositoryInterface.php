<?php

namespace App\Repositories\Contracts;

use App\Models\Reservasi;
use Illuminate\Database\Eloquent\Collection;

interface ReservasiRepositoryInterface
{
    /**
     * Find reservasi by ID
     */
    public function findById(int $id): ?Reservasi;

    /**
     * Find reservasi by ID with relations
     */
    public function findByIdWithRelations(int $id): ?Reservasi;

    /**
     * Create new reservasi
     */
    public function create(array $data): Reservasi;

    /**
     * Update reservasi
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete reservasi
     */
    public function delete(int $id): bool;

    /**
     * Get all reservasi by user ID
     */
    public function getByUserId(int $userId): Collection;

    /**
     * Get pending reservasi (Diajukan, Diproses)
     */
    public function getPending(): Collection;

    /**
     * Get completed reservasi (Selesai)
     */
    public function getCompleted(): Collection;

    /**
     * Get reservasi by status
     */
    public function getByStatus(string $status): Collection;

    /**
     * Get all with relations (for admin view)
     */
    public function getAllWithRelations(): Collection;

    /**
     * Get laporan data with date range
     */
    public function getLaporanByDateRange(string $startDate, string $endDate): Collection;
}

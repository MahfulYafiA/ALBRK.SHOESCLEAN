<?php

namespace App\Backend\Repositories\Contracts;

use App\Backend\Models\Reservasi;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface ReservasiRepositoryInterface
{
    /**
     * Get all reservations
     */
    public function getAll(): Collection;

    /**
     * Get reservations by user
     */
    public function getByUser(int $userId): Collection;

    /**
     * Get active reservations (queue)
     */
    public function getAntrean(): Collection;

    /**
     * Get completed reservations
     */
    public function getSelesai(): Collection;

    /**
     * Find reservation by ID
     */
    public function findById(int $id): ?Reservasi;

    /**
     * Create new reservation
     */
    public function create(array $data): Reservasi;

    /**
     * Update reservation
     */
    public function update(Reservasi $reservasi, array $data): Reservasi;

    /**
     * Update status
     */
    public function updateStatus(int $id, string $status): Reservasi;

    /**
     * Delete reservation
     */
    public function delete(int $id): bool;

    /**
     * Count by status
     */
    public function countByStatus(string $status): int;

    /**
     * Get filtered reservations
     */
    public function getFiltered(Request $request): Collection;

    /**
     * Calculate total omzet
     */
    public function getTotalOmzet(): int;

    /**
     * Get monthly omzet
     */
    public function getMonthlyOmzet(int $year, int $month): int;
}

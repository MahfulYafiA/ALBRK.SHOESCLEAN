<?php

namespace App\Repositories\Contracts;

use App\Models\Layanan;
use Illuminate\Database\Eloquent\Collection;

interface LayananRepositoryInterface
{
    /**
     * Find layanan by ID
     */
    public function findById(int $id): ?Layanan;

    /**
     * Get all layanan
     */
    public function getAll(): Collection;

    /**
     * Get active layanan ordered by ID
     */
    public function getActiveOrdered(): Collection;

    /**
     * Create new layanan
     */
    public function create(array $data): Layanan;

    /**
     * Update layanan
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete layanan
     */
    public function delete(int $id): bool;
}

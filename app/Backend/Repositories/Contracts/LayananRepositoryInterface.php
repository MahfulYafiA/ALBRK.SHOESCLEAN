<?php

namespace App\Backend\Repositories\Contracts;

use App\Backend\Models\Layanan;
use Illuminate\Database\Eloquent\Collection;

interface LayananRepositoryInterface
{
    /**
     * Get all services
     */
    public function getAll(): Collection;

    /**
     * Get active services
     */
    public function getActive(): Collection;

    /**
     * Find service by ID
     */
    public function findById(int $id): ?Layanan;

    /**
     * Create new service
     */
    public function create(array $data): Layanan;

    /**
     * Update service
     */
    public function update(Layanan $layanan, array $data): Layanan;

    /**
     * Delete service
     */
    public function delete(int $id): bool;
}

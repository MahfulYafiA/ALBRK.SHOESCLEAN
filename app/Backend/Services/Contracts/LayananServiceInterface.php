<?php

namespace App\Backend\Services\Contracts;

interface LayananServiceInterface
{
    /**
     * Get all services
     */
    public function getAllLayanan(): array;

    /**
     * Get active services
     */
    public function getActiveLayanan(): array;

    /**
     * Find layanan by ID
     */
    public function findLayanan(int $id): ?array;

    /**
     * Create new layanan
     */
    public function createLayanan(array $data): array;

    /**
     * Update layanan
     */
    public function updateLayanan(int $id, array $data): array;

    /**
     * Delete layanan
     */
    public function deleteLayanan(int $id): bool;
}

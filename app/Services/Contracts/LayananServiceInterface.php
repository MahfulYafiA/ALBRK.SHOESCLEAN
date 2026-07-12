<?php

namespace App\Services\Contracts;

use App\DTOs\LayananDTO;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface LayananServiceInterface
{
    /**
     * Get all layanan
     */
    public function getAll(): Collection;

    /**
     * Get layanan by ID
     */
    public function getById(int $id): ?Layanan;

    /**
     * Create new layanan
     */
    public function create(LayananDTO $dto): Layanan;

    /**
     * Update layanan
     */
    public function update(int $id, LayananDTO $dto): bool;

    /**
     * Delete layanan
     */
    public function delete(int $id): bool;

    /**
     * Update hero banner image
     */
    public function updateHeroBanner(Request $request): bool;

    /**
     * Update tentang kami image
     */
    public function updateTentangKami(Request $request): bool;

    /**
     * Get hero image URL
     */
    public function getHeroImageUrl(): string;

    /**
     * Get tentang kami image URL
     */
    public function getTentangImageUrl(): string;
}

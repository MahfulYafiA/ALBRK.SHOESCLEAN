<?php

namespace App\Repositories;

use App\Models\Layanan;
use App\Repositories\Contracts\LayananRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class LayananRepository implements LayananRepositoryInterface
{
    /**
     * Find layanan by ID
     */
    public function findById(int $id): ?Layanan
    {
        return Layanan::find($id);
    }

    /**
     * Get all layanan
     */
    public function getAll(): Collection
    {
        return Layanan::orderBy('id_layanan', 'desc')->get();
    }

    /**
     * Get active layanan ordered by ID
     */
    public function getActiveOrdered(): Collection
    {
        return Layanan::orderBy('id_layanan')->get();
    }

    /**
     * Create new layanan
     */
    public function create(array $data): Layanan
    {
        return Layanan::create($data);
    }

    /**
     * Update layanan
     */
    public function update(int $id, array $data): bool
    {
        $layanan = $this->findById($id);
        if (!$layanan) {
            return false;
        }
        return $layanan->update($data);
    }

    /**
     * Delete layanan
     */
    public function delete(int $id): bool
    {
        $layanan = $this->findById($id);
        if (!$layanan) {
            return false;
        }

        // Delete associated image file
        if ($layanan->gambar) {
            Storage::disk('public')->delete($layanan->gambar);
        }

        return $layanan->delete();
    }
}

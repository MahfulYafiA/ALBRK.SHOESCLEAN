<?php

namespace App\Repositories;

use App\Models\Reservasi;
use App\Repositories\Contracts\ReservasiRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ReservasiRepository implements ReservasiRepositoryInterface
{
    /**
     * Find reservasi by ID
     */
    public function findById(int $id): ?Reservasi
    {
        return Reservasi::find($id);
    }

    /**
     * Find reservasi by ID with relations
     */
    public function findByIdWithRelations(int $id): ?Reservasi
    {
        return Reservasi::with(['user', 'detail.layanan', 'pembayaran'])
            ->find($id);
    }

    /**
     * Create new reservasi
     */
    public function create(array $data): Reservasi
    {
        return Reservasi::create($data);
    }

    /**
     * Update reservasi
     */
    public function update(int $id, array $data): bool
    {
        $reservasi = $this->findById($id);
        if (!$reservasi) {
            return false;
        }
        return $reservasi->update($data);
    }

    /**
     * Delete reservasi
     */
    public function delete(int $id): bool
    {
        $reservasi = $this->findById($id);
        if (!$reservasi) {
            return false;
        }
        return $reservasi->delete();
    }

    /**
     * Get all reservasi by user ID
     */
    public function getByUserId(int $userId): Collection
    {
        return Reservasi::with(['detail.layanan', 'pembayaran'])
            ->where('id_user', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get pending reservasi (Diajukan, Diproses)
     */
    public function getPending(): Collection
    {
        return Reservasi::with(['user', 'detail.layanan', 'pembayaran'])
            ->whereIn('status', ['Diajukan', 'Diproses'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get completed reservasi (Selesai)
     */
    public function getCompleted(): Collection
    {
        return Reservasi::where('status', 'Selesai')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get reservasi by status
     */
    public function getByStatus(string $status): Collection
    {
        return Reservasi::with(['user', 'detail.layanan', 'pembayaran'])
            ->where('status', $status)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get all with relations (for admin view)
     */
    public function getAllWithRelations(): Collection
    {
        return Reservasi::with(['user', 'detail.layanan', 'pembayaran'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get laporan data with date range
     */
    public function getLaporanByDateRange(string $startDate, string $endDate): Collection
    {
        return Reservasi::with(['user', 'detail.layanan', 'pembayaran'])
            ->whereBetween('tanggal_reservasi', [$startDate, $endDate])
            ->orderBy('tanggal_reservasi', 'desc')
            ->get();
    }
}

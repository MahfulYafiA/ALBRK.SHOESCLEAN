<?php

namespace App\Repositories;

use App\Models\Pembayaran;
use App\Models\Reservasi;
use App\Repositories\Contracts\PembayaranRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class PembayaranRepository implements PembayaranRepositoryInterface
{
    /**
     * Find pembayaran by ID
     */
    public function findById(int $id): ?Pembayaran
    {
        return Pembayaran::find($id);
    }

    /**
     * Find pembayaran by reservasi ID
     */
    public function findByReservasiId(int $reservasiId): ?Pembayaran
    {
        return Pembayaran::where('id_reservasi', $reservasiId)->first();
    }

    /**
     * Create new pembayaran
     */
    public function create(array $data): Pembayaran
    {
        return Pembayaran::create($data);
    }

    /**
     * Update pembayaran
     */
    public function update(int $id, array $data): bool
    {
        $pembayaran = $this->findById($id);
        if (!$pembayaran) {
            return false;
        }
        return $pembayaran->update($data);
    }

    /**
     * Delete pembayaran
     */
    public function delete(int $id): bool
    {
        $pembayaran = $this->findById($id);
        if (!$pembayaran) {
            return false;
        }
        return $pembayaran->delete();
    }

    /**
     * Delete pembayaran by reservasi ID
     */
    public function deleteByReservasiId(int $reservasiId): bool
    {
        return Pembayaran::where('id_reservasi', $reservasiId)->delete();
    }

    /**
     * Get all pembayaran with relations
     */
    public function getAllWithRelations(): Collection
    {
        return Pembayaran::with('reservasi.user')
            ->orderBy('tanggal', 'desc')
            ->get();
    }

    /**
     * Get pembayaran by date range
     */
    public function getByDateRange(string $startDate, string $endDate): Collection
    {
        return Pembayaran::with('reservasi')
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->orderBy('tanggal', 'desc')
            ->get();
    }

    /**
     * Create or update pembayaran for reservasi
     */
    public function upsertByReservasi(Reservasi $reservasi, array $data): Pembayaran
    {
        $existing = $this->findByReservasiId($reservasi->id_reservasi);

        if ($existing) {
            $existing->update($data);
            return $existing;
        }

        $data['id_reservasi'] = $reservasi->id_reservasi;
        $data['tanggal'] = $data['tanggal'] ?? Carbon::now();
        return $this->create($data);
    }
}

<?php

namespace App\Services\Contracts;

use App\DTOs\ReservasiDTO;
use App\Models\Layanan;
use App\Models\Reservasi;
use Illuminate\Http\Request;

interface ReservasiServiceInterface
{
    /**
     * Create new reservasi
     */
    public function createReservasi(ReservasiDTO $dto, int $userId): Reservasi;

    /**
     * Calculate total price
     */
    public function calculateTotal(Layanan $layanan, int $jumlah): array;

    /**
     * Update status reservasi
     */
    public function updateStatus(int $reservasiId, string $status): Reservasi;

    /**
     * Set return/delivery method
     */
    public function setReturnMethod(int $reservasiId, array $methodData): Reservasi;

    /**
     * Get reservasi for pembayaran page
     */
    public function getReservasiForPembayaran(int $reservasiId): ?Reservasi;

    /**
     * Cancel reservasi
     */
    public function cancelReservasi(int $reservasiId): bool;

    /**
     * Delete reservasi (for cascade delete)
     */
    public function deleteByUserId(int $userId): bool;
}

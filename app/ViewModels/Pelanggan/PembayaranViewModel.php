<?php

namespace App\ViewModels\Pelanggan;

use App\Backend\Services\Contracts\MidtransServiceInterface;
use App\Backend\Services\Contracts\ReservasiServiceInterface;

class PembayaranViewModel
{
    public function __construct(
        private ReservasiServiceInterface $reservasiService,
        private MidtransServiceInterface $midtransService
    ) {}

    /**
     * Get reservasi for payment
     */
    public function getReservasiForPayment(int $id): ?array
    {
        $reservasi = $this->reservasiService->findReservasi($id);

        // Check if user owns this reservation
        if ($reservasi && $reservasi['id_user'] !== auth()->id()) {
            return null;
        }

        return $reservasi;
    }

    /**
     * Generate Snap Token for Midtrans
     */
    public function generateSnapToken(int $reservasiId): ?string
    {
        return $this->midtransService->getSnapToken($reservasiId);
    }
}

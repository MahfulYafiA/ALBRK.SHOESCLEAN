<?php

namespace App\ViewModels\Pelanggan;

use App\Models\Reservasi;
use App\Services\Contracts\MidtransServiceInterface;
use App\Services\Contracts\ReservasiServiceInterface;

class PembayaranViewModel
{
    public function __construct(
        private ReservasiServiceInterface $reservasiService,
        private MidtransServiceInterface $midtransService
    ) {}

    /**
     * Get reservasi for payment page
     */
    public function getReservasiForPayment(int $reservasiId): ?Reservasi
    {
        $reservasi = $this->reservasiService->getReservasiForPembayaran($reservasiId);

        // Check ownership
        if ($reservasi && $reservasi->id_user !== auth()->id()) {
            return null;
        }

        return $reservasi;
    }

    /**
     * Generate Midtrans snap token
     */
    public function generateSnapToken(int $reservasiId): ?string
    {
        $reservasi = $this->getReservasiForPayment($reservasiId);

        if (!$reservasi) {
            return null;
        }

        try {
            return $this->midtransService->generateSnapToken($reservasi);
        } catch (\Exception $e) {
            return null;
        }
    }
}

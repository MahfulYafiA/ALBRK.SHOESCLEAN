<?php

namespace App\ViewModels\Pelanggan;

use App\Backend\Services\Contracts\LayananServiceInterface;
use App\Backend\Services\Contracts\ReservasiServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReservasiViewModel
{
    public function __construct(
        private LayananServiceInterface $layananService,
        private ReservasiServiceInterface $reservasiService
    ) {}

    /**
     * Get available services
     */
    public function getLayanans(): array
    {
        return $this->layananService->getActiveLayanan();
    }

    /**
     * Create new reservation
     */
    public function createReservasi(Request $request)
    {
        $result = $this->reservasiService->createReservasi([
            'id_user' => auth()->id(),
            'id_layanan' => $request->id_layanan,
            'jumlah_sepatu' => $request->jumlah_sepatu ?? 1,
            'metode_layanan' => $request->metode_layanan,
            'alamat_jemput' => $request->alamat_jemput,
            'metode_pengembalian' => $request->metode_pengembalian,
            'wa_pengantaran' => $request->wa_pengantaran,
            'alamat_pengantaran' => $request->alamat_pengantaran,
            'catatan' => $request->catatan,
            'metode_pembayaran' => $request->metode_pembayaran,
        ]);

        if (!$result['success']) {
            return back()->with('error', $result['message'])->withInput();
        }

        return $result['reservasi'];
    }
}

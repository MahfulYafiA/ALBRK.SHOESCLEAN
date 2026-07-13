<?php

namespace App\ViewModels\Pelanggan;

use App\Backend\Services\Contracts\ReservasiServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RiwayatViewModel
{
    public function __construct(
        private ReservasiServiceInterface $reservasiService
    ) {}

    /**
     * Get riwayat reservasi for current user
     */
    public function getRiwayatReservasi(): array
    {
        return $this->reservasiService->getReservasiByUser(auth()->id());
    }

    /**
     * Update return method
     */
    public function updatePengembalian(Request $request, int $id): RedirectResponse
    {
        $reservasi = $this->reservasiService->findReservasi($id);

        if (!$reservasi || $reservasi['id_user'] !== auth()->id()) {
            return back()->with('error', 'Reservasi tidak ditemukan.');
        }

        $result = $this->reservasiService->updateReservasi($id, [
            'metode_pengembalian' => $request->metode_pengembalian,
            'wa_pengantaran' => $request->wa_pengantaran,
            'alamat_pengantaran' => $request->alamat_pengantaran,
        ]);

        if ($result['success']) {
            return back()->with('success', 'Metode pengembalian berhasil diperbarui.');
        }

        return back()->with('error', $result['message']);
    }

    /**
     * Cancel reservation
     */
    public function cancelReservasi(int $id): RedirectResponse
    {
        $reservasi = $this->reservasiService->findReservasi($id);

        if (!$reservasi || $reservasi['id_user'] !== auth()->id()) {
            return back()->with('error', 'Reservasi tidak ditemukan.');
        }

        if (!in_array($reservasi['status'], ['menunggu', 'di_terima'])) {
            return back()->with('error', 'Reservasi tidak dapat dibatalkan.');
        }

        $result = $this->reservasiService->cancelReservasi($id);

        if ($result) {
            return redirect()->route('reservasi.riwayat')->with('success', 'Reservasi berhasil dibatalkan.');
        }

        return back()->with('error', 'Gagal membatalkan reservasi.');
    }
}

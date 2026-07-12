<?php

namespace App\ViewModels\Pelanggan;

use App\Http\Requests\Reservasi\UpdatePengembalianRequest;
use App\Models\Reservasi;
use App\Repositories\Contracts\ReservasiRepositoryInterface;
use App\Services\Contracts\ReservasiServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;

class RiwayatViewModel
{
    public function __construct(
        private ReservasiRepositoryInterface $reservasiRepository,
        private ReservasiServiceInterface $reservasiService
    ) {}

    /**
     * Get all reservasi history for current user
     */
    public function getRiwayatReservasi(): Collection
    {
        return $this->reservasiRepository->getByUserId(auth()->id());
    }

    /**
     * Update return/delivery method
     */
    public function updatePengembalian(UpdatePengembalianRequest $request, int $reservasiId): RedirectResponse
    {
        $reservasi = $this->reservasiRepository->findByIdWithRelations($reservasiId);

        // Check ownership
        if (!$reservasi || $reservasi->id_user !== auth()->id()) {
            return redirect()->back()->with('error', 'Reservasi tidak ditemukan.');
        }

        try {
            $this->reservasiService->setReturnMethod($reservasiId, $request->validated());
            return redirect()->back()->with('success', 'Metode pengembalian berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui metode pengembalian.');
        }
    }

    /**
     * Cancel reservasi
     */
    public function cancelReservasi(int $reservasiId): RedirectResponse
    {
        $reservasi = $this->reservasiRepository->findById($reservasiId);

        // Check ownership
        if (!$reservasi || $reservasi->id_user !== auth()->id()) {
            return redirect()->back()->with('error', 'Reservasi tidak ditemukan.');
        }

        // Only allow cancel for Diajukan status
        if ($reservasi->status !== 'Diajukan') {
            return redirect()->back()->with('error', 'Reservasi tidak dapat dibatalkan.');
        }

        try {
            $this->reservasiService->cancelReservasi($reservasiId);
            return redirect()->back()->with('success', 'Reservasi berhasil dibatalkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membatalkan reservasi.');
        }
    }
}

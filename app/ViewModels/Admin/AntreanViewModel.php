<?php

namespace App\ViewModels\Admin;

use App\Http\Requests\Admin\UpdateStatusRequest;
use App\Models\Reservasi;
use App\Repositories\Contracts\ReservasiRepositoryInterface;
use App\Services\Contracts\ReservasiServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;

class AntreanViewModel
{
    public function __construct(
        private ReservasiRepositoryInterface $reservasiRepository,
        private ReservasiServiceInterface $reservasiService
    ) {}

    /**
     * Get all antrean (pending reservations)
     */
    public function getAntreanList(): Collection
    {
        return $this->reservasiRepository->getPending();
    }

    /**
     * Update reservasi status
     */
    public function updateStatus(UpdateStatusRequest $request, int $reservasiId): RedirectResponse
    {
        $reservasi = $this->reservasiRepository->findById($reservasiId);

        if (!$reservasi) {
            return redirect()->back()->with('error', 'Reservasi tidak ditemukan.');
        }

        try {
            $this->reservasiService->updateStatus($reservasiId, $request->status);
            return redirect()->back()->with('success', 'Status reservasi berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui status.');
        }
    }

    /**
     * Delete reservasi
     */
    public function deleteReservasi(int $reservasiId): RedirectResponse
    {
        $reservasi = $this->reservasiRepository->findById($reservasiId);

        if (!$reservasi) {
            return redirect()->back()->with('error', 'Reservasi tidak ditemukan.');
        }

        try {
            $this->reservasiRepository->delete($reservasiId);
            return redirect()->back()->with('success', 'Reservasi berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus reservasi.');
        }
    }
}

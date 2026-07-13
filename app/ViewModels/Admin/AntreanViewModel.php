<?php

namespace App\ViewModels\Admin;

use App\Backend\Models\Reservasi;
use App\Backend\Services\Contracts\ReservasiServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AntreanViewModel
{
    public function __construct(
        private ReservasiServiceInterface $reservasiService
    ) {}

    /**
     * Get antrean data
     */
    public function getAntrean(): Collection
    {
        return Reservasi::with(['user', 'detailReservasis.layanan'])
            ->whereIn('status', ['Diajukan', 'Menunggu Konfirmasi', 'Diproses'])
            ->orderBy('tanggal_reservasi', 'asc')
            ->get();
    }

    /**
     * Update status
     */
    public function updateStatus(int $id, string $status): array
    {
        return $this->reservasiService->updateStatus($id, $status);
    }

    /**
     * Delete reservation
     */
    public function deleteReservasi(int $id): bool
    {
        return $this->reservasiService->deleteReservasi($id);
    }
}

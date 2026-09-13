<?php

namespace App\ViewModels\Admin;

use App\Repositories\Contracts\ReservasiRepositoryInterface;
use App\Services\Contracts\ReservasiServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AntreanViewModel
{
    public function __construct(
        private ReservasiServiceInterface $reservasiService,
        private ReservasiRepositoryInterface $reservasiRepository,
    ) {}

    /**
     * Get antrean data
     */
    public function getAntrean(): Collection
    {
        return $this->reservasiRepository->getAntrean();
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

<?php

namespace App\ViewModels\Pelanggan;

use App\DTOs\ReservasiDTO;
use App\Http\Requests\Reservasi\StoreReservasiRequest;
use App\Models\Reservasi;
use App\Repositories\Contracts\LayananRepositoryInterface;
use App\Services\Contracts\ReservasiServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;

class ReservasiViewModel
{
    public function __construct(
        private LayananRepositoryInterface $layananRepository,
        private ReservasiServiceInterface $reservasiService
    ) {}

    /**
     * Get layanan list for dropdown
     */
    public function getLayanans(): Collection
    {
        return $this->layananRepository->getActiveOrdered();
    }

    /**
     * Create new reservasi
     */
    public function createReservasi(StoreReservasiRequest $request): Reservasi
    {
        $dto = ReservasiDTO::fromRequest($request->validated());
        return $this->reservasiService->createReservasi($dto, auth()->id());
    }

    /**
     * Get created reservasi with relations
     */
    public function getCreatedReservasiWithRelations(int $reservasiId): ?Reservasi
    {
        return $this->reservasiService->getReservasiForPembayaran($reservasiId);
    }
}

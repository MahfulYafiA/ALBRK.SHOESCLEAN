<?php

namespace App\ViewModels\Admin;

use App\DTOs\DashboardStatsDTO;
use App\Repositories\Contracts\ReservasiRepositoryInterface;
use App\Services\Contracts\DashboardServiceInterface;
use Illuminate\Support\Collection;

class DashboardViewModel
{
    public function __construct(
        private DashboardServiceInterface $dashboardService,
        private ReservasiRepositoryInterface $reservasiRepository
    ) {}

    /**
     * Get admin dashboard data
     */
    public function getDashboardData(): array
    {
        $stats = $this->dashboardService->getAdminStats();
        $recentReservasis = $this->dashboardService->getRecentReservasi(10);
        $antreanReservasis = $this->reservasiRepository->getPending();

        return [
            'stats' => $stats->toArray(),
            'recent_reservasis' => $recentReservasis,
            'antrean_reservasis' => $antreanReservasis,
        ];
    }
}

<?php

namespace App\ViewModels\Pelanggan;

use App\Backend\Services\Contracts\DashboardServiceInterface;
use App\Backend\Services\Contracts\ReservasiServiceInterface;

class DashboardViewModel
{
    public function __construct(
        private DashboardServiceInterface $dashboardService,
        private ReservasiServiceInterface $reservasiService
    ) {}

    /**
     * Get dashboard data for pelanggan
     */
    public function getDashboardData(): array
    {
        $userId = auth()->id();
        $stats = $this->dashboardService->getPelangganStats($userId);

        return [
            'stats' => $stats,
        ];
    }
}

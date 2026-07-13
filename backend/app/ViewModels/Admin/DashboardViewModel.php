<?php

namespace App\ViewModels\Admin;

use App\Backend\Services\Contracts\DashboardServiceInterface;

class DashboardViewModel
{
    public function __construct(
        private DashboardServiceInterface $dashboardService
    ) {}

    /**
     * Get dashboard data for admin
     */
    public function getDashboardData(): array
    {
        return $this->dashboardService->getAdminStats();
    }
}

<?php

namespace App\Services\Contracts;

use App\DTOs\DashboardStatsDTO;
use Illuminate\Support\Collection;

interface DashboardServiceInterface
{
    /**
     * Get admin dashboard statistics
     */
    public function getAdminStats(): DashboardStatsDTO;

    /**
     * Get superadmin dashboard statistics
     */
    public function getSuperAdminStats(): DashboardStatsDTO;

    /**
     * Get omzet data by date range
     */
    public function getOmzetByDateRange(string $startDate, string $endDate): array;

    /**
     * Get recent reservations
     */
    public function getRecentReservasi(int $limit = 10): Collection;

    /**
     * Get reservations by status
     */
    public function getReservasiByStatus(string $status): Collection;
}

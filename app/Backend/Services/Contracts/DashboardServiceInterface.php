<?php

namespace App\Backend\Services\Contracts;

interface DashboardServiceInterface
{
    /**
     * Get dashboard statistics for admin
     */
    public function getAdminStats(): array;

    /**
     * Get dashboard statistics for pelanggan
     */
    public function getPelangganStats(int $userId): array;

    /**
     * Get monthly report data
     */
    public function getMonthlyReport(int $year, int $month): array;

    /**
     * Get yearly report data
     */
    public function getYearlyReport(int $year): array;
}

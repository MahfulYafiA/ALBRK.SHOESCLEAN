<?php

namespace App\ViewModels\Admin;

use App\Repositories\Contracts\ReservasiRepositoryInterface;
use App\Services\Contracts\DashboardServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class LaporanViewModel
{
    public function __construct(
        private DashboardServiceInterface $dashboardService,
        private ReservasiRepositoryInterface $reservasiRepository
    ) {}

    /**
     * Get laporan data with optional date filter
     */
    public function getLaporanData(Request $request): array
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->endOfMonth()->format('Y-m-d'));

        $omzetData = $this->dashboardService->getOmzetByDateRange($startDate, $endDate);

        return [
            'reservasis' => $omzetData['reservasis'],
            'total_omzet' => $omzetData['total_omzet'],
            'formatted_omzet' => $omzetData['formatted_omzet'],
            'total_transaksi' => $omzetData['total_transaksi'],
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];
    }
}

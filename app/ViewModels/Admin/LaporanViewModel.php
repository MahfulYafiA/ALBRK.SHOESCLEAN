<?php

namespace App\ViewModels\Admin;

use App\Services\Contracts\DashboardServiceInterface;
use App\Repositories\Contracts\ReservasiRepositoryInterface;
use App\Services\Contracts\ReservasiServiceInterface;
use Illuminate\Http\Request;

class LaporanViewModel
{
    public function __construct(
        private DashboardServiceInterface $dashboardService,
        private ReservasiServiceInterface $reservasiService,
        private ReservasiRepositoryInterface $reservasiRepository,
    ) {}

    /**
     * Get laporan data
     */
    public function getLaporanData(Request $request): array
    {
        $year = $request->year ?? date('Y');
        $month = $request->month ?? date('m');

        $monthlyReport = $this->dashboardService->getMonthlyReport((int)$year, (int)$month);
        $yearlyReport = $this->dashboardService->getYearlyReport((int)$year);

        // Default tanggal: harian (hari ini)
        $defaultStartDate = date('Y-m-d');
        $defaultEndDate = date('Y-m-d');

        $startDate = $request->start_date ?? $request->tgl_mulai ?? $request->tanggal_awal ?? $defaultStartDate;
        $endDate = $request->end_date ?? $request->tgl_selesai ?? $request->tanggal_akhir ?? $defaultEndDate;

        // Filter hanya diterapkan jika user memilih tanggal
        $hasFilter = $request->filled('start_date') || $request->filled('end_date');

        $reservasis = $this->reservasiRepository->getReport(
            $hasFilter ? $startDate : $defaultStartDate,
            $hasFilter ? $endDate : $defaultEndDate,
            $request->filled('status') ? $request->status : null,
        );
        $totalOmzet = (int) $reservasis->where('status_bayar', 'Lunas')->sum('total_harga');

        $filters = [
            'status' => $request->status,
            'tanggal_awal' => $startDate,
            'tanggal_akhir' => $endDate,
        ];

        return [
            'monthly_report' => $monthlyReport,
            'yearly_report' => $yearlyReport,
            'reservasis' => $reservasis,
            'laporan' => $reservasis,
            'laporanOmzet' => $reservasis,
            'total_omzet' => $totalOmzet,
            'totalOmzet' => $totalOmzet,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'tgl_mulai' => $startDate,
            'tgl_selesai' => $endDate,
            'filters' => $filters,
        ];
    }
}

<?php

namespace App\ViewModels\Admin;

use App\Backend\Services\Contracts\DashboardServiceInterface;
use App\Backend\Models\Reservasi;
use App\Backend\Services\Contracts\ReservasiServiceInterface;
use Illuminate\Http\Request;

class LaporanViewModel
{
    public function __construct(
        private DashboardServiceInterface $dashboardService,
        private ReservasiServiceInterface $reservasiService
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

        $startDate = $request->start_date ?? $request->tgl_mulai ?? $request->tanggal_awal;
        $endDate = $request->end_date ?? $request->tgl_selesai ?? $request->tanggal_akhir;

        $query = Reservasi::with(['user', 'detailReservasis.layanan'])
            ->where('status', '!=', 'dibatalkan');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($startDate) {
            $query->whereDate('tanggal_reservasi', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('tanggal_reservasi', '<=', $endDate);
        }

        $reservasis = $query->orderBy('tanggal_reservasi', 'desc')->get();
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

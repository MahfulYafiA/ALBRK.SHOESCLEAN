<?php

namespace App\Services\Dashboard;

use App\DTOs\DashboardStatsDTO;
use App\Models\Reservasi;
use App\Repositories\Contracts\ReservasiRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\DashboardServiceInterface;
use Illuminate\Support\Collection;

class DashboardService implements DashboardServiceInterface
{
    public function __construct(
        private ReservasiRepositoryInterface $reservasiRepository,
        private UserRepositoryInterface $userRepository
    ) {}

    /**
     * Get admin dashboard statistics
     */
    public function getAdminStats(): DashboardStatsDTO
    {
        $totalAntrean = Reservasi::whereIn('status', ['Diajukan', 'Diproses'])->count();
        $totalSelesai = Reservasi::where('status', 'Selesai')->count();
        $totalReservasi = Reservasi::count();
        $totalPelanggan = $this->userRepository->getAllPelanggan()->count();

        // Calculate omzet from completed reservations
        $totalOmzet = Reservasi::where('status', 'Selesai')
            ->where('status_bayar', 'Lunas')
            ->sum('total_harga');

        return DashboardStatsDTO::fromArray([
            'total_antrean' => $totalAntrean,
            'total_selesai' => $totalSelesai,
            'total_reservasi' => $totalReservasi,
            'total_pelanggan' => $totalPelanggan,
            'total_omzet' => $totalOmzet,
        ]);
    }

    /**
     * Get superadmin dashboard statistics
     */
    public function getSuperAdminStats(): DashboardStatsDTO
    {
        // Same as admin stats for now
        return $this->getAdminStats();
    }

    /**
     * Get omzet data by date range
     */
    public function getOmzetByDateRange(string $startDate, string $endDate): array
    {
        $reservasis = $this->reservasiRepository->getLaporanByDateRange($startDate, $endDate);

        $totalOmzet = $reservasis->where('status', 'Selesai')
            ->where('status_bayar', 'Lunas')
            ->sum('total_harga');

        $totalTransaksi = $reservasis->count();

        return [
            'reservasis' => $reservasis,
            'total_omzet' => $totalOmzet,
            'formatted_omzet' => 'Rp ' . number_format($totalOmzet, 0, ',', '.'),
            'total_transaksi' => $totalTransaksi,
        ];
    }

    /**
     * Get recent reservations
     */
    public function getRecentReservasi(int $limit = 10): Collection
    {
        return $this->reservasiRepository->getAllWithRelations()->take($limit);
    }

    /**
     * Get reservations by status
     */
    public function getReservasiByStatus(string $status): Collection
    {
        return $this->reservasiRepository->getByStatus($status);
    }
}

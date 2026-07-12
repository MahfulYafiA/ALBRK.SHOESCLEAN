<?php

namespace App\ViewModels\Pelanggan;

use App\DTOs\DashboardStatsDTO;
use App\Models\Reservasi;
use App\Repositories\Contracts\ReservasiRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Collection;

class DashboardViewModel
{
    public function __construct(
        private ReservasiRepositoryInterface $reservasiRepository,
        private UserRepositoryInterface $userRepository
    ) {}

    /**
     * Get dashboard data for pelanggan
     */
    public function getDashboardData(): array
    {
        $userId = auth()->id();
        $reservasis = $this->reservasiRepository->getByUserId($userId);

        $stats = [
            'total_reservasi' => $reservasis->count(),
            'reservasi_aktif' => $reservasis->whereIn('status', ['Diajukan', 'Diproses'])->count(),
            'reservasi_selesai' => $reservasis->where('status', 'Selesai')->count(),
            'total_pengeluaran' => $reservasis->where('status', 'Selesai')->sum('total_harga'),
        ];

        return [
            'stats' => $stats,
            'recent_reservasis' => $reservasis->take(5),
            'user' => auth()->user(),
        ];
    }
}

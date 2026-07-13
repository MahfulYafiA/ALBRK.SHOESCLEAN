<?php

namespace App\Backend\DTOs;

class DashboardStatsDTO
{
    public function __construct(
        public readonly int $totalAntrean,
        public readonly int $totalSelesai,
        public readonly int $totalPelanggan,
        public readonly int $totalOmzet,
        public readonly int $totalMenunggu,
        public readonly int $totalDiproses,
    ) {}

    public function toArray(): array
    {
        return [
            'total_antrean' => $this->totalAntrean,
            'total_selesai' => $this->totalSelesai,
            'total_pelanggan' => $this->totalPelanggan,
            'total_omzet' => $this->totalOmzet,
            'total_menunggu' => $this->totalMenunggu,
            'total_diproses' => $this->totalDiproses,
        ];
    }

    public function getFormattedOmzet(): string
    {
        return 'Rp ' . number_format($this->totalOmzet, 0, ',', '.');
    }
}

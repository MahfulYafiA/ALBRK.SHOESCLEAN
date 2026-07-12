<?php

namespace App\DTOs;

readonly class DashboardStatsDTO
{
    public function __construct(
        public int $totalAntrean,
        public int $totalSelesai,
        public int $totalReservasi,
        public int $totalPelanggan,
        public float $totalOmzet,
    ) {}

    /**
     * Create DTO from raw stats array
     */
    public static function fromArray(array $stats): self
    {
        return new self(
            totalAntrean: $stats['total_antrean'] ?? 0,
            totalSelesai: $stats['total_selesai'] ?? 0,
            totalReservasi: $stats['total_reservasi'] ?? 0,
            totalPelanggan: $stats['total_pelanggan'] ?? 0,
            totalOmzet: (float) ($stats['total_omzet'] ?? 0),
        );
    }

    /**
     * Get formatted omzet for display
     */
    public function getFormattedOmzet(): string
    {
        return 'Rp ' . number_format($this->totalOmzet, 0, ',', '.');
    }

    /**
     * Convert to array for view
     */
    public function toArray(): array
    {
        return [
            'total_antrean' => $this->totalAntrean,
            'total_selesai' => $this->totalSelesai,
            'total_reservasi' => $this->totalReservasi,
            'total_pelanggan' => $this->totalPelanggan,
            'total_omzet' => $this->totalOmzet,
            'formatted_omzet' => $this->getFormattedOmzet(),
        ];
    }
}

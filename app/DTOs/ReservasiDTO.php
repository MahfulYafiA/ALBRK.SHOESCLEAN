<?php

namespace App\DTOs;

use Carbon\Carbon;

readonly class ReservasiDTO
{
    public function __construct(
        public int $idUser,
        public int $idLayanan,
        public int $jumlahSepatu,
        public string $metodeLayanan,
        public ?string $alamatJemput,
        public string $metodePembayaran,
        public ?Carbon $tanggalReservasi = null,
        public ?string $waPengantaran = null,
        public ?string $alamatPengantaran = null,
    ) {}

    /**
     * Create DTO from validated request data
     */
    public static function fromRequest(array $data): self
    {
        return new self(
            idUser: auth()->id(),
            idLayanan: (int) $data['id_layanan'],
            jumlahSepatu: (int) $data['jumlah_sepatu'],
            metodeLayanan: $data['metode_layanan'],
            alamatJemput: $data['alamat_jemput'] ?? null,
            metodePembayaran: $data['metode_pembayaran'],
            tanggalReservasi: Carbon::now(),
        );
    }

    /**
     * Convert to array for database insertion
     */
    public function toArray(): array
    {
        return [
            'id_user' => $this->idUser,
            'tanggal_reservasi' => $this->tanggalReservasi ?? Carbon::now(),
            'metode_layanan' => $this->metodeLayanan,
            'alamat_jemput' => $this->alamatJemput,
            'status' => 'Diajukan',
            'status_bayar' => 'Belum Lunas',
            'total_harga' => 0, // Will be calculated in service
            'wa_pengantaran' => $this->waPengantaran,
            'alamat_pengantaran' => $this->alamatPengantaran,
        ];
    }
}

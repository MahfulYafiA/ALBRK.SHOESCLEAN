<?php

namespace App\DTOs;

use Carbon\Carbon;

readonly class PembayaranDTO
{
    public function __construct(
        public int $idReservasi,
        public string $metodeBayar,
        public int $jumlah,
        public ?Carbon $tanggal = null,
    ) {}

    /**
     * Create DTO from request data
     */
    public static function fromRequest(array $data, int $jumlah): self
    {
        return new self(
            idReservasi: (int) $data['id_reservasi'],
            metodeBayar: $data['metode_bayar'] ?? self::getMetodeBayar($data['metode_pembayaran'] ?? ''),
            jumlah: $jumlah,
            tanggal: Carbon::now(),
        );
    }

    /**
     * Create DTO for offline payment (cash)
     */
    public static function forOfflinePayment(int $idReservasi, int $jumlah): self
    {
        return new self(
            idReservasi: $idReservasi,
            metodeBayar: 'Cash',
            jumlah: $jumlah,
            tanggal: Carbon::now(),
        );
    }

    /**
     * Get payment method string based on type
     */
    private static function getMetodeBayar(string $metodePembayaran): string
    {
        if ($metodePembayaran === 'Payment Gateway') {
            return 'Payment Gateway';
        }
        return 'Tunai';
    }

    /**
     * Convert to array for database insertion
     */
    public function toArray(): array
    {
        return [
            'id_reservasi' => $this->idReservasi,
            'metode_bayar' => $this->metodeBayar,
            'tanggal' => $this->tanggal ?? Carbon::now(),
            'jumlah' => $this->jumlah,
        ];
    }
}

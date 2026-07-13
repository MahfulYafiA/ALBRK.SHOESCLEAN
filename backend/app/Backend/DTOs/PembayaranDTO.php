<?php

namespace App\Backend\DTOs;

use App\Backend\Models\Pembayaran;

class PembayaranDTO
{
    public function __construct(
        public readonly int $id,
        public readonly int $idReservasi,
        public readonly int $jumlah,
        public readonly string $metode,
        public readonly string $status,
        public readonly ?string $tanggalBayar = null,
        public readonly ?string $buktiPembayaran = null,
        public readonly ?string $midtransOrderId = null,
        public readonly ?string $snapToken = null,
    ) {}

    public static function fromModel(Pembayaran $pembayaran): self
    {
        return new self(
            id: $pembayaran->id_pembayaran,
            idReservasi: $pembayaran->id_reservasi,
            jumlah: $pembayaran->jumlah,
            metode: $pembayaran->metode,
            status: $pembayaran->status,
            tanggalBayar: $pembayaran->tanggal_bayar?->format('Y-m-d H:i:s'),
            buktiPembayaran: $pembayaran->bukti_pembayaran,
            midtransOrderId: $pembayaran->midtrans_order_id,
            snapToken: $pembayaran->snap_token,
        );
    }

    public function toArray(): array
    {
        return [
            'id_pembayaran' => $this->id,
            'id_reservasi' => $this->idReservasi,
            'jumlah' => $this->jumlah,
            'metode' => $this->metode,
            'status' => $this->status,
            'tanggal_bayar' => $this->tanggalBayar,
            'bukti_pembayaran' => $this->buktiPembayaran,
            'midtrans_order_id' => $this->midtransOrderId,
            'snap_token' => $this->snapToken,
        ];
    }

    public function getFormattedJumlah(): string
    {
        return 'Rp ' . number_format($this->jumlah, 0, ',', '.');
    }

    public function isLunas(): bool
    {
        return $this->status === 'lunas';
    }
}

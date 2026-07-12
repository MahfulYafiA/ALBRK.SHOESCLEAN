<?php

namespace App\DTOs;

readonly class LayananDTO
{
    public function __construct(
        public string $namaLayanan,
        public int $harga,
        public ?string $deskripsi = null,
        public ?string $gambar = null,
    ) {}

    /**
     * Create DTO from request data
     */
    public static function fromRequest(array $data, ?string $gambar = null): self
    {
        return new self(
            namaLayanan: $data['nama_layanan'],
            harga: (int) $data['harga'],
            deskripsi: $data['deskripsi'] ?? null,
            gambar: $gambar,
        );
    }

    /**
     * Convert to array for database insertion
     */
    public function toArray(): array
    {
        return [
            'nama_layanan' => $this->namaLayanan,
            'harga' => $this->harga,
            'deskripsi' => $this->deskripsi,
            'gambar' => $this->gambar,
        ];
    }
}

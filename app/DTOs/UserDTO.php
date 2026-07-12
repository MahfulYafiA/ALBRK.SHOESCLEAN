<?php

namespace App\DTOs;

use Carbon\Carbon;

readonly class UserDTO
{
    public function __construct(
        public string $nama,
        public string $email,
        public ?string $password,
        public int $idRole,
        public ?string $noTelp = null,
        public ?string $alamat = null,
        public ?string $fotoProfil = null,
        public ?string $googleId = null,
    ) {}

    /**
     * Create DTO for regular registration
     */
    public static function fromRegisterRequest(array $data): self
    {
        return new self(
            nama: $data['nama'],
            email: $data['email'],
            password: bcrypt($data['password']),
            idRole: 3, // Pelanggan
            noTelp: $data['no_telp'] ?? null,
            alamat: $data['alamat'] ?? null,
        );
    }

    /**
     * Create DTO for admin-created user
     */
    public static function fromAdminRequest(array $data, int $roleId): self
    {
        return new self(
            nama: $data['nama'],
            email: $data['email'],
            password: bcrypt($data['password']),
            idRole: $roleId,
            noTelp: $data['no_telp'] ?? null,
            alamat: $data['alamat'] ?? null,
        );
    }

    /**
     * Create DTO from Google OAuth user
     */
    public static function fromGoogleUser(array $googleUser): self
    {
        return new self(
            nama: substr($googleUser['name'] ?? 'User', 0, 40),
            email: $googleUser['email'],
            password: null,
            idRole: 3, // Pelanggan
            googleId: $googleUser['id'] ?? null,
        );
    }

    /**
     * Convert to array for database insertion
     */
    public function toArray(): array
    {
        $data = [
            'nama' => $this->nama,
            'email' => $this->email,
            'id_role' => $this->idRole,
            'no_telp' => $this->noTelp,
            'alamat' => $this->alamat,
        ];

        if ($this->password) {
            $data['password'] = $this->password;
        }

        if ($this->googleId) {
            $data['google_id'] = $this->googleId;
        }

        return $data;
    }
}

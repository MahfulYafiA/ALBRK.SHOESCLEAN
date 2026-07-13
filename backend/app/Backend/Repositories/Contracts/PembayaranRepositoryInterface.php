<?php

namespace App\Backend\Repositories\Contracts;

use App\Backend\Models\Pembayaran;
use Illuminate\Database\Eloquent\Collection;

interface PembayaranRepositoryInterface
{
    /**
     * Get all payments
     */
    public function getAll(): Collection;

    /**
     * Get payment by reservation
     */
    public function getByReservasi(int $reservasiId): ?Pembayaran;

    /**
     * Find payment by ID
     */
    public function findById(int $id): ?Pembayaran;

    /**
     * Create new payment
     */
    public function create(array $data): Pembayaran;

    /**
     * Update payment
     */
    public function update(Pembayaran $pembayaran, array $data): Pembayaran;

    /**
     * Update status
     */
    public function updateStatus(int $id, string $status): Pembayaran;

    /**
     * Get payment by Midtrans order ID
     */
    public function findByOrderId(string $orderId): ?Pembayaran;
}

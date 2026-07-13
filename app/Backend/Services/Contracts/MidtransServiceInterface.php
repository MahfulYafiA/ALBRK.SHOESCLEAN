<?php

namespace App\Backend\Services\Contracts;

interface MidtransServiceInterface
{
    /**
     * Get Snap Token for payment
     */
    public function getSnapToken(int $reservasiId): ?string;

    /**
     * Process callback from Midtrans
     */
    public function processCallback(array $notification): array;

    /**
     * Check transaction status
     */
    public function checkTransaction(string $orderId): ?array;
}

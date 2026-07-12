<?php

namespace App\Services\Contracts;

use App\Models\Reservasi;
use Illuminate\Http\Request;

interface MidtransServiceInterface
{
    /**
     * Generate Snap Token for payment
     */
    public function generateSnapToken(Reservasi $reservasi): string;

    /**
     * Handle Midtrans callback/webhook
     */
    public function handleCallback(Request $request): bool;

    /**
     * Validate callback signature
     */
    public function validateSignature(string $orderId, string $statusCode, string $grossAmount, string $signatureKey): bool;
}

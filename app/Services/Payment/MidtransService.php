<?php

namespace App\Services\Payment;

use App\DTOs\MidtransParamsDTO;
use App\Models\Reservasi;
use App\Repositories\Contracts\PembayaranRepositoryInterface;
use App\Repositories\Contracts\ReservasiRepositoryInterface;
use App\Services\Contracts\MidtransServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransService implements MidtransServiceInterface
{
    public function __construct(
        private ReservasiRepositoryInterface $reservasiRepository,
        private PembayaranRepositoryInterface $pembayaranRepository
    ) {
        // Configure Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    /**
     * Generate Snap Token for payment
     */
    public function generateSnapToken(Reservasi $reservasi): string
    {
        $dto = MidtransParamsDTO::fromReservasi($reservasi);
        $params = $dto->toMidtransParams();

        // Add callbacks
        $params['callbacks'] = [
            'finish' => route('reservasi.riwayat'),
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return $snapToken;
        } catch (\Exception $e) {
            throw new \Exception('Gagal generate token pembayaran: ' . $e->getMessage());
        }
    }

    /**
     * Handle Midtrans callback/webhook
     */
    public function handleCallback(Request $request): bool
    {
        $orderId = $request->order_id;
        $statusCode = $request->status_code;
        $grossAmount = $request->gross_amount;
        $signatureKey = $request->signature_key;

        // Validate signature
        if (!$this->validateSignature($orderId, $statusCode, $grossAmount, $signatureKey)) {
            return false;
        }

        // Extract reservasi ID from order_id (format: RES-{id}-{timestamp})
        $parts = explode('-', $orderId);
        if (count($parts) < 2) {
            return false;
        }
        $reservasiId = (int) $parts[1];

        $reservasi = $this->reservasiRepository->findById($reservasiId);
        if (!$reservasi) {
            return false;
        }

        $transactionStatus = $request->transaction_status;

        return DB::transaction(function () use ($reservasi, $transactionStatus, $request) {
            if ($transactionStatus === 'settlement' || $transactionStatus === 'capture') {
                // Payment successful
                $this->reservasiRepository->update($reservasi->id_reservasi, [
                    'status_bayar' => 'Lunas'
                ]);

                $this->pembayaranRepository->upsertByReservasi($reservasi, [
                    'metode_bayar' => 'Payment Gateway',
                    'tanggal' => Carbon::now(),
                    'jumlah' => $reservasi->total_harga,
                ]);
            } elseif ($transactionStatus === 'pending') {
                // Payment pending
                // No change needed
            } elseif ($transactionStatus === 'deny' || $transactionStatus === 'cancel' || $transactionStatus === 'expire') {
                // Payment failed
                $this->reservasiRepository->update($reservasi->id_reservasi, [
                    'status_bayar' => 'Belum Lunas'
                ]);
            }

            return true;
        });
    }

    /**
     * Validate callback signature
     */
    public function validateSignature(string $orderId, string $statusCode, string $grossAmount, string $signatureKey): bool
    {
        $serverKey = config('services.midtrans.server_key');
        $mySignatureKey = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        return $mySignatureKey === $signatureKey;
    }
}

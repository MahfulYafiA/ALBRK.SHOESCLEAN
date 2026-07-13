<?php

namespace App\Backend\Services\Payment;

use App\Backend\DTOs\MidtransParamsDTO;
use App\Backend\Models\Pembayaran;
use App\Backend\Models\Reservasi;
use App\Backend\Repositories\Contracts\PembayaranRepositoryInterface;
use App\Backend\Repositories\Contracts\ReservasiRepositoryInterface;
use App\Backend\Services\Contracts\MidtransServiceInterface;
use Carbon\Carbon;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Facades\Log;

class MidtransService implements MidtransServiceInterface
{
    public function __construct(
        private PembayaranRepositoryInterface $pembayaranRepository,
        private ReservasiRepositoryInterface $reservasiRepository
    ) {
        // Configure Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function getSnapToken(int $reservasiId): ?string
    {
        try {
            $reservasi = $this->reservasiRepository->findById($reservasiId);

            if (!$reservasi) {
                return null;
            }

            $orderId = 'RSV-' . $reservasi->id_reservasi . '-' . time();

            $params = new MidtransParamsDTO(
                orderId: $orderId,
                grossAmount: $reservasi->total_harga,
                customerName: $reservasi->user->nama ?? 'Pelanggan',
                customerEmail: $reservasi->user->email ?? 'pelanggan@albrk.com',
                phone: $reservasi->user->no_telp,
            );

            // Update pembayaran with order ID
            $pembayaran = $this->pembayaranRepository->getByReservasi($reservasiId);
            if ($pembayaran) {
                $this->pembayaranRepository->update($pembayaran, [
                    'midtrans_order_id' => $orderId,
                ]);
            }

            $snapToken = Snap::getSnapToken($params->toMidtransParams());

            // Store snap token
            if ($pembayaran) {
                $this->pembayaranRepository->update($pembayaran, [
                    'snap_token' => $snapToken,
                ]);
            }

            return $snapToken;
        } catch (\Exception $e) {
            Log::error('Midtrans Error: ' . $e->getMessage());
            return null;
        }
    }

    public function processCallback(array $notification): array
    {
        try {
            $orderId = $notification['order_id'];
            $transactionStatus = $notification['transaction_status'];
            $pembayaran = $this->pembayaranRepository->findByOrderId($orderId);

            if (!$pembayaran) {
                return [
                    'success' => false,
                    'message' => 'Pembayaran tidak ditemukan',
                ];
            }

            $status = match($transactionStatus) {
                'capture', 'settlement' => 'lunas',
                'pending' => 'menunggu',
                'deny', 'expire', 'cancel' => 'gagal',
                default => $pembayaran->status,
            };

            $updateData = [
                'status' => $status,
                'midtrans_transaction_id' => $notification['transaction_id'] ?? null,
            ];

            if ($status === 'lunas') {
                $updateData['tanggal_bayar'] = Carbon::now();
            }

            $this->pembayaranRepository->update($pembayaran, $updateData);

            // Update reservasi status if payment is successful
            if ($status === 'lunas') {
                $this->reservasiRepository->updateStatus(
                    $pembayaran->id_reservasi,
                    'menunggu'
                );
            }

            return [
                'success' => true,
                'message' => 'Callback berhasil diproses',
                'status' => $status,
            ];
        } catch (\Exception $e) {
            Log::error('Midtrans Callback Error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function checkTransaction(string $orderId): ?array
    {
        try {
            $status = \Midtrans\Transaction::status($orderId);
            return (array) $status;
        } catch (\Exception $e) {
            Log::error('Midtrans Check Transaction Error: ' . $e->getMessage());
            return null;
        }
    }
}

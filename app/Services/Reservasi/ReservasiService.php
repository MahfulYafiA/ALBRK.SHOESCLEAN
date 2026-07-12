<?php

namespace App\Services\Reservasi;

use App\DTOs\ReservasiDTO;
use App\Models\DetailReservasi;
use App\Models\Layanan;
use App\Models\Reservasi;
use App\Repositories\Contracts\LayananRepositoryInterface;
use App\Repositories\Contracts\PembayaranRepositoryInterface;
use App\Repositories\Contracts\ReservasiRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\ReservasiServiceInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReservasiService implements ReservasiServiceInterface
{
    public function __construct(
        private ReservasiRepositoryInterface $reservasiRepository,
        private PembayaranRepositoryInterface $pembayaranRepository,
        private UserRepositoryInterface $userRepository,
        private LayananRepositoryInterface $layananRepository
    ) {}

    /**
     * Create new reservasi
     */
    public function createReservasi(ReservasiDTO $dto, int $userId): Reservasi
    {
        $layanan = $this->layananRepository->findById($dto->idLayanan);

        if (!$layanan) {
            throw new \Exception('Layanan tidak ditemukan');
        }

        // Calculate total
        $totals = $this->calculateTotal($layanan, $dto->jumlahSepatu);

        return DB::transaction(function () use ($dto, $userId, $totals, $layanan) {
            // Update pickup address if pick-up method
            if ($dto->metodeLayanan === 'Pick-up' && $dto->alamatJemput) {
                $user = $this->userRepository->findById($userId);
                $this->userRepository->updatePickupAddress($user, $dto->alamatJemput);
            }

            // Create reservasi
            $reservasi = $this->reservasiRepository->create([
                'id_user' => $userId,
                'tanggal_reservasi' => Carbon::now(),
                'metode_layanan' => $dto->metodeLayanan,
                'alamat_jemput' => $dto->alamatJemput,
                'status' => 'Diajukan',
                'status_bayar' => 'Belum Lunas',
                'total_harga' => $totals['total'],
            ]);

            // Create detail reservasi
            DetailReservasi::create([
                'id_reservasi' => $reservasi->id_reservasi,
                'id_layanan' => $layanan->id_layanan,
                'harga' => $layanan->harga,
                'jumlah' => $dto->jumlahSepatu,
                'sub_total' => $totals['sub_total'],
            ]);

            // Create pembayaran record
            $metodeBayar = $dto->metodePembayaran === 'Payment Gateway'
                ? 'Payment Gateway'
                : 'Tunai';

            $this->pembayaranRepository->create([
                'id_reservasi' => $reservasi->id_reservasi,
                'metode_bayar' => $metodeBayar,
                'tanggal' => Carbon::now(),
                'jumlah' => $totals['total'],
            ]);

            return $reservasi->fresh(['user', 'detail.layanan', 'pembayaran']);
        });
    }

    /**
     * Calculate total price
     */
    public function calculateTotal(Layanan $layanan, int $jumlah): array
    {
        $subTotal = $layanan->harga * $jumlah;

        return [
            'sub_total' => $subTotal,
            'total' => $subTotal, // bisa tambahkan pajak/ongkir di sini
        ];
    }

    /**
     * Update status reservasi
     */
    public function updateStatus(int $reservasiId, string $status): Reservasi
    {
        $reservasi = $this->reservasiRepository->findById($reservasiId);

        if (!$reservasi) {
            throw new \Exception('Reservasi tidak ditemukan');
        }

        $updateData = ['status' => $status];

        // If status is Selesai, update payment status to Lunas
        if ($status === 'Selesai') {
            $updateData['status_bayar'] = 'Lunas';
        }

        $this->reservasiRepository->update($reservasiId, $updateData);

        return $reservasi->fresh(['user', 'detail.layanan', 'pembayaran']);
    }

    /**
     * Set return/delivery method
     */
    public function setReturnMethod(int $reservasiId, array $methodData): Reservasi
    {
        $reservasi = $this->reservasiRepository->findById($reservasiId);

        if (!$reservasi) {
            throw new \Exception('Reservasi tidak ditemukan');
        }

        $updateData = [];

        if ($methodData['metode'] === 'Diantar ke Alamat') {
            $updateData['wa_pengantaran'] = $methodData['wa_pengantaran'] ?? null;
            $updateData['alamat_pengantaran'] = $methodData['alamat_pengantaran'] ?? null;
        }

        if (!empty($updateData)) {
            $this->reservasiRepository->update($reservasiId, $updateData);
        }

        return $reservasi->fresh(['user', 'detail.layanan', 'pembayaran']);
    }

    /**
     * Get reservasi for pembayaran page
     */
    public function getReservasiForPembayaran(int $reservasiId): ?Reservasi
    {
        return $this->reservasiRepository->findByIdWithRelations($reservasiId);
    }

    /**
     * Cancel reservasi
     */
    public function cancelReservasi(int $reservasiId): bool
    {
        return $this->updateStatus($reservasiId, 'Dibatalkan');
    }

    /**
     * Delete reservasi by user ID (for cascade delete)
     */
    public function deleteByUserId(int $userId): bool
    {
        $reservasis = $this->reservasiRepository->getByUserId($userId);

        foreach ($reservasis as $reservasi) {
            // Delete pembayaran first
            $this->pembayaranRepository->deleteByReservasiId($reservasi->id_reservasi);

            // Delete detail reservasi
            $reservasi->detail()->delete();

            // Delete reservasi
            $this->reservasiRepository->delete($reservasi->id_reservasi);
        }

        return true;
    }
}

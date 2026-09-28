<?php

namespace App\Services\Reservasi;

use App\DTOs\ReservasiDTO;
use App\Repositories\Contracts\DetailReservasiRepositoryInterface;
use App\Repositories\Contracts\LayananRepositoryInterface;
use App\Repositories\Contracts\ReservasiRepositoryInterface;
use App\Services\Contracts\ReservasiServiceInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReservasiService implements ReservasiServiceInterface
{
    public function __construct(
        private ReservasiRepositoryInterface $reservasiRepository,
        private LayananRepositoryInterface $layananRepository,
        private DetailReservasiRepositoryInterface $detailReservasiRepository,
    ) {}

    public function getAllReservasi(): array
    {
        $reservasis = $this->reservasiRepository->getAll();
        return $reservasis->map(fn($r) => ReservasiDTO::fromModel($r)->toArray())->toArray();
    }

    public function getReservasiByUser(int $userId): array
    {
        $reservasis = $this->reservasiRepository->getByUser($userId);
        return $reservasis->map(fn($r) => ReservasiDTO::fromModel($r)->toArray())->toArray();
    }

    public function getAntrean(): array
    {
        $reservasis = $this->reservasiRepository->getAntrean();
        return $reservasis->map(fn($r) => ReservasiDTO::fromModel($r)->toArray())->toArray();
    }

    public function findReservasi(int $id): ?array
    {
        $reservasi = $this->reservasiRepository->findById($id);
        return $reservasi ? ReservasiDTO::fromModel($reservasi)->toArray() : null;
    }

    public function createReservasi(array $data): array
    {
        try {
            DB::beginTransaction();

            $idLayanans = array_values(array_unique(array_map('intval', $data['id_layanans'] ?? [])));
            if ($idLayanans === []) {
                throw new \RuntimeException('Pilih minimal satu layanan.');
            }

            $layanans = collect($idLayanans)->map(function (int $idLayanan) {
                $layanan = $this->layananRepository->findById($idLayanan);
                if (! $layanan || $layanan->status !== 'Aktif') {
                    throw new \RuntimeException('Salah satu layanan tidak tersedia.');
                }

                return $layanan;
            });
            $jumlahSepatu = (int) ($data['jumlah_sepatu'] ?? 1);
            $totalHarga = $layanans->sum(fn ($layanan) => $layanan->harga) * $jumlahSepatu;

            // Create reservation
            $reservasi = $this->reservasiRepository->create([
                'id_user' => $data['id_user'],
                'tanggal_reservasi' => Carbon::now()->toDateString(),
                'jumlah_sepatu' => $jumlahSepatu,
                'metode_layanan' => $data['metode_layanan'],
                'alamat_jemput' => $data['alamat_jemput'] ?? null,
                'metode_pengembalian' => $data['metode_pengembalian'],
                'status_pengambilan' => $data['metode_pengembalian'] === 'diantar' ? 'diantar' : 'perlu_diambil',
                'status' => 'menunggu',
                'status_bayar' => $data['metode_pembayaran'] === 'Payment Gateway' ? 'Belum Lunas' : 'Lunas',
                'metode_bayar' => $data['metode_pembayaran'] === 'Payment Gateway' ? 'Midtrans' : 'Tunai',
                'tanggal_bayar' => $data['metode_pembayaran'] === 'Payment Gateway' ? null : Carbon::now(),
                'total_harga' => $totalHarga,
                'wa_pengantaran' => $data['wa_pengantaran'] ?? null,
                'alamat_pengantaran' => $data['alamat_pengantaran'] ?? null,
                'catatan' => $data['catatan'] ?? null,
            ]);

            // Store one detail row for each selected service.
            foreach ($layanans as $layanan) {
                $this->detailReservasiRepository->create([
                    'id_reservasi' => $reservasi->id_reservasi,
                    'id_layanan' => $layanan->id_layanan,
                    'harga' => $layanan->harga,
                    'jumlah' => $jumlahSepatu,
                    'sub_total' => $layanan->harga * $jumlahSepatu,
                ]);
            }

            DB::commit();

            return [
                'success' => true,
                'reservasi' => ReservasiDTO::fromModel($reservasi->fresh())->toArray(),
                'message' => 'Reservasi berhasil dibuat',
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'success' => false,
                'message' => 'Gagal membuat reservasi: ' . $e->getMessage(),
            ];
        }
    }

    public function updateReservasi(int $id, array $data): array
    {
        $reservasi = $this->reservasiRepository->findById($id);

        if (!$reservasi) {
            return [
                'success' => false,
                'message' => 'Reservasi tidak ditemukan',
            ];
        }

        $reservasi = $this->reservasiRepository->update($reservasi, $data);

        return [
            'success' => true,
            'reservasi' => ReservasiDTO::fromModel($reservasi)->toArray(),
            'message' => 'Reservasi berhasil diperbarui',
        ];
    }

    public function updateStatus(int $id, string $status): array
    {
        $reservasi = $this->reservasiRepository->findById($id);

        if (!$reservasi) {
            return [
                'success' => false,
                'message' => 'Reservasi tidak ditemukan',
            ];
        }

        $updateData = ['status' => $status];

        // If taken, update status_pengambilan
        if ($status === 'diambil') {
            $updateData['status_pengambilan'] = 'sudah_diambil';
        }

        $reservasi = $this->reservasiRepository->update($reservasi, $updateData);

        return [
            'success' => true,
            'reservasi' => ReservasiDTO::fromModel($reservasi)->toArray(),
            'message' => 'Status berhasil diperbarui',
        ];
    }

    public function cancelReservasi(int $id): bool
    {
        $reservasi = $this->reservasiRepository->findById($id);

        if (!$reservasi) {
            return false;
        }

        // Only allow cancel if status is waiting or accepted
        if (!in_array($reservasi->status, ['menunggu', 'di_terima'])) {
            return false;
        }

        $this->reservasiRepository->update($reservasi, ['status' => 'dibatalkan']);
        return true;
    }

    public function deleteReservasi(int $id): bool
    {
        return $this->reservasiRepository->delete($id);
    }

    public function getFilteredReservasi(array $filters): array
    {
        // Convert filters to Request-like format
        $request = new \Illuminate\Http\Request($filters);
        $reservasis = $this->reservasiRepository->getFiltered($request);
        return $reservasis->map(fn($r) => ReservasiDTO::fromModel($r)->toArray())->toArray();
    }
}

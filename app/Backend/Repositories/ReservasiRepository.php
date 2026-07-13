<?php

namespace App\Backend\Repositories;

use App\Backend\Models\Reservasi;
use App\Backend\Repositories\Contracts\ReservasiRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ReservasiRepository implements ReservasiRepositoryInterface
{
    public function getAll(): Collection
    {
        return Reservasi::with(['user', 'detailReservasis'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getByUser(int $userId): Collection
    {
        return Reservasi::with(['user', 'detailReservasis'])
            ->where('id_user', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getAntrean(): Collection
    {
        return Reservasi::with(['user', 'detailReservasis'])
            ->whereIn('status', ['menunggu', 'di_terima', 'sedang_diproses'])
            ->orderBy('tanggal_reservasi', 'asc')
            ->get();
    }

    public function getSelesai(): Collection
    {
        return Reservasi::with(['user', 'detailReservasis'])
            ->where('status', 'selesai')
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    public function findById(int $id): ?Reservasi
    {
        return Reservasi::with(['user', 'detailReservasis.layanan'])
            ->find($id);
    }

    public function create(array $data): Reservasi
    {
        return Reservasi::create($data);
    }

    public function update(Reservasi $reservasi, array $data): Reservasi
    {
        $reservasi->update($data);
        return $reservasi->fresh();
    }

    public function updateStatus(int $id, string $status): Reservasi
    {
        $reservasi = $this->findById($id);
        $reservasi->update(['status' => $status]);
        return $reservasi->fresh();
    }

    public function delete(int $id): bool
    {
        $reservasi = $this->findById($id);
        return $reservasi ? $reservasi->delete() : false;
    }

    public function countByStatus(string $status): int
    {
        return Reservasi::where('status', $status)->count();
    }

    public function getFiltered(Request $request): Collection
    {
        $query = Reservasi::with(['user', 'detailReservasis']);

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('tanggal_awal') && $request->tanggal_awal) {
            $query->whereDate('tanggal_reservasi', '>=', $request->tanggal_awal);
        }

        if ($request->has('tanggal_akhir') && $request->tanggal_akhir) {
            $query->whereDate('tanggal_reservasi', '<=', $request->tanggal_akhir);
        }

        return $query->orderBy('tanggal_reservasi', 'desc')->get();
    }

    public function getTotalOmzet(): int
    {
        return Reservasi::where('status', '!=', 'dibatalkan')
            ->where('status_bayar', 'Lunas')
            ->sum('total_harga');
    }

    public function getMonthlyOmzet(int $year, int $month): int
    {
        return Reservasi::whereYear('tanggal_reservasi', $year)
            ->whereMonth('tanggal_reservasi', $month)
            ->where('status', '!=', 'dibatalkan')
            ->where('status_bayar', 'Lunas')
            ->sum('total_harga');
    }
}

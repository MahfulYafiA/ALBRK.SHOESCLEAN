<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reservasi\StoreReservasiRequest;
use App\Http\Requests\Reservasi\UpdatePengembalianRequest;
use App\ViewModels\Pelanggan\DashboardViewModel;
use App\ViewModels\Pelanggan\PembayaranViewModel;
use App\ViewModels\Pelanggan\ReservasiViewModel;
use App\ViewModels\Pelanggan\RiwayatViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReservasiController extends Controller
{
    public function __construct(
        private DashboardViewModel $dashboardViewModel,
        private ReservasiViewModel $reservasiViewModel,
        private PembayaranViewModel $pembayaranViewModel,
        private RiwayatViewModel $riwayatViewModel
    ) {}

    /**
     * Show dashboard
     */
    public function dashboard(): View
    {
        $data = $this->dashboardViewModel->getDashboardData();
        return view('pelanggan.dashboard', $data);
    }

    /**
     * Show create reservasi form
     */
    public function create(): View
    {
        $layanans = $this->reservasiViewModel->getLayanans();
        return view('pelanggan.reservasi.create', compact('layanans'));
    }

    /**
     * Store new reservasi
     */
    public function store(StoreReservasiRequest $request): RedirectResponse
    {
        $reservasi = $this->reservasiViewModel->createReservasi($request);

        if ($request->metode_pembayaran === 'Payment Gateway') {
            return redirect()->route('reservasi.pembayaran', $reservasi->id_reservasi);
        }

        return redirect()->route('reservasi.riwayat')->with('success', 'Reservasi berhasil dibuat!');
    }

    /**
     * Show payment page
     */
    public function pembayaran(int $id): View
    {
        $reservasi = $this->pembayaranViewModel->getReservasiForPayment($id);

        if (!$reservasi) {
            return redirect()->route('reservasi.riwayat')->with('error', 'Reservasi tidak ditemukan.');
        }

        $snapToken = $this->pembayaranViewModel->generateSnapToken($id);

        return view('pelanggan.reservasi.pembayaran', compact('reservasi', 'snapToken'));
    }

    /**
     * Show riwayat reservasi
     */
    public function riwayat(): View
    {
        $reservasis = $this->riwayatViewModel->getRiwayatReservasi();
        return view('pelanggan.reservasi.riwayat', compact('reservasis'));
    }

    /**
     * Update return method
     */
    public function pilihPengembalian(UpdatePengembalianRequest $request, int $id): RedirectResponse
    {
        return $this->riwayatViewModel->updatePengembalian($request, $id);
    }

    /**
     * Cancel reservasi
     */
    public function cancel(int $id): RedirectResponse
    {
        return $this->riwayatViewModel->cancelReservasi($id);
    }
}

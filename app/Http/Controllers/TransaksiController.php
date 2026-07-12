<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\ReservasiRepositoryInterface;
use App\Repositories\Contracts\PembayaranRepositoryInterface;
use App\Services\Contracts\MidtransServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TransaksiController extends Controller
{
    public function __construct(
        private ReservasiRepositoryInterface $reservasiRepository,
        private PembayaranRepositoryInterface $pembayaranRepository
    ) {}

    /**
     * Show offline transaction form
     */
    public function createOffline()
    {
        return view('admin.transaksi.offline');
    }

    /**
     * Store offline transaction
     */
    public function storeOffline(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:40',
            'no_telp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string|max:200',
            'id_layanan' => 'required|exists:ms_layanan,id_layanan',
            'jumlah_sepatu' => 'required|integer|min:1',
            'metode_layanan' => 'required|in:Drop-off,Pick-up',
            'metode_bayar' => 'required|in:Cash,Bayar di Kasir',
        ], [
            'nama.required' => 'Nama pelanggan wajib diisi.',
            'id_layanan.required' => 'Pilih layanan.',
            'id_layanan.exists' => 'Layanan tidak ditemukan.',
            'jumlah_sepatu.required' => 'Jumlah sepatu wajib diisi.',
            'jumlah_sepatu.integer' => 'Jumlah sepatu harus angka.',
            'jumlah_sepatu.min' => 'Jumlah minimal 1.',
            'metode_layanan.required' => 'Pilih metode layanan.',
            'metode_bayar.required' => 'Pilih metode pembayaran.',
        ]);

        try {
            return DB::transaction(function () use ($request) {
                // Get layanan
                $layanan = \App\Models\Layanan::findOrFail($request->id_layanan);
                $subTotal = $layanan->harga * $request->jumlah_sepatu;

                // Create or find customer
                $customer = \App\Models\User::where('no_telp', $request->no_telp)->first();

                if (!$customer) {
                    $customer = \App\Models\User::create([
                        'nama' => $request->nama,
                        'email' => 'offline_' . time() . '@local.com',
                        'password' => bcrypt('offline_' . time()),
                        'id_role' => 3,
                        'no_telp' => $request->no_telp,
                        'alamat' => $request->alamat,
                    ]);
                }

                // Create reservasi
                $reservasi = $this->reservasiRepository->create([
                    'id_user' => $customer->id_user,
                    'tanggal_reservasi' => now(),
                    'metode_layanan' => $request->metode_layanan,
                    'alamat_jemput' => $request->alamat_jemput ?? null,
                    'status' => 'Selesai',
                    'status_bayar' => 'Lunas',
                    'total_harga' => $subTotal,
                ]);

                // Create detail
                \App\Models\DetailReservasi::create([
                    'id_reservasi' => $reservasi->id_reservasi,
                    'id_layanan' => $layanan->id_layanan,
                    'harga' => $layanan->harga,
                    'jumlah' => $request->jumlah_sepatu,
                    'sub_total' => $subTotal,
                ]);

                // Create pembayaran
                $this->pembayaranRepository->create([
                    'id_reservasi' => $reservasi->id_reservasi,
                    'metode_bayar' => $request->metode_bayar,
                    'tanggal' => now(),
                    'jumlah' => $subTotal,
                ]);

                return redirect()->back()->with('success', 'Transaksi offline berhasil dicatat.');
            });
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan transaksi: ' . $e->getMessage());
        }
    }
}

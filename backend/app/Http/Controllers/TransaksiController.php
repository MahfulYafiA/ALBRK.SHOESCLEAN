<?php

namespace App\Http\Controllers;

use App\Backend\Models\Layanan;
use App\Backend\Models\Reservasi;
use App\Backend\Models\DetailReservasi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    /**
     * Show offline transaction form
     */
    public function createOffline(): View
    {
        $layanans = Layanan::where('status', 'Aktif')->orderBy('nama_layanan')->get();
        return view('admin.transaksi.offline', compact('layanans'));
    }

    /**
     * Store offline transaction
     */
    public function storeOffline(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_telp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:200',
            'id_layanan' => 'required|exists:ms_layanan,id_layanan',
            'jumlah_sepatu' => 'required|integer|min:1',
            'metode_layanan' => 'required|string',
            'metode_bayar' => 'required|string',
            'catatan' => 'nullable|string|max:500',
        ]);

        try {
            DB::beginTransaction();

            $layanan = Layanan::findOrFail($request->id_layanan);
            $jumlahSepatu = (int) $request->jumlah_sepatu;
            $totalHarga = $layanan->harga * $jumlahSepatu;

            // Create reservation
            $reservasi = Reservasi::create([
                'id_user' => auth()->id(),
                'nama_pelanggan' => $request->nama,
                'no_hp' => $request->no_telp,
                'jenis_sepatu' => '-',
                'tanggal_reservasi' => Carbon::now()->toDateString(),
                'jumlah_sepatu' => $jumlahSepatu,
                'metode_layanan' => $request->metode_layanan,
                'alamat_jemput' => $request->alamat,
                'status' => 'di_terima',
                'status_bayar' => 'Lunas',
                'tanggal_bayar' => Carbon::now()->toDateTimeString(),
                'metode_bayar' => $request->metode_bayar,
                'total_harga' => $totalHarga,
                'metode_masuk' => $request->metode_layanan === 'Pick-up' ? 'Jemput Kurir' : 'Antar Sendiri',
                'metode_keluar' => 'Ambil Sendiri',
                'catatan' => $request->catatan,
                'status_pengambilan' => 'perlu_diambil',
            ]);

            // Create detail reservasi
            DetailReservasi::create([
                'id_reservasi' => $reservasi->id_reservasi,
                'id_layanan' => $layanan->id_layanan,
                'harga' => $layanan->harga,
                'jumlah' => $jumlahSepatu,
                'sub_total' => $totalHarga,
            ]);

            DB::commit();

            return redirect()->route('admin.antrean')->with('success', 'Transaksi offline berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menyimpan transaksi: ' . $e->getMessage())->withInput();
        }
    }
}

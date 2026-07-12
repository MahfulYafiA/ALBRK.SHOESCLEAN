<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;
use App\Models\Reservasi;
use App\Models\DetailReservasi;
use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; 

// Impor library Midtrans
use Midtrans\Config;
use Midtrans\Snap;

class ReservasiController extends Controller
{
    /**
     * Menampilkan Form Reservasi
     */
    public function create()
    {
        $layanans = Layanan::all(); 
        $user = auth()->user();
        
        return view('pelanggan.reservasi.create', compact('layanans', 'user'));
    }

    /**
     * Menampilkan Form Pembayaran Midtrans (Bayar Nanti dari Riwayat)
     */
    public function pembayaran($id)
    {
        // ✅ UPDATE: Menambahkan relasi 'pembayaran' agar datanya bisa dibaca di View
        $reservasi = Reservasi::with(['user', 'layanan', 'pembayaran'])
                    ->where('id_reservasi', $id)
                    ->where('id_user', auth()->user()->id_user)
                    ->firstOrFail();

        // CEK STRUKTUR BARU: Menggunakan status_bayar
        if ($reservasi->status_bayar == 'Lunas') {
            return redirect()->route('reservasi.riwayat')->with('success', 'Pesanan ini sudah lunas atau sedang diproses.');
        }

        $snapToken = $this->generateMidtransToken($reservasi);

        return view('pelanggan.reservasi.pembayaran', compact('reservasi', 'snapToken'));
    }

    /**
     * Menyimpan data reservasi
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_layanan'        => 'required|exists:ms_layanan,id_layanan',
            'jumlah_sepatu'     => 'required|integer|min:1',
            'metode_layanan'    => 'required|in:Drop-off,Pick-up',
            'metode_pembayaran' => 'required',
            'alamat_jemput'     => 'nullable|string|max:200', // Sesuai VARCHAR 200
            'no_telp'           => 'nullable|string|max:15', 
        ]);

        DB::beginTransaction();

        try {
            $user = auth()->user();
            $layanan = Layanan::findOrFail($request->id_layanan);
            
            // PERHITUNGAN UNTUK STRUKTUR BARU
            $harga_satuan = $layanan->harga;
            $jumlah_sepatu = $request->jumlah_sepatu;
            $sub_total = $harga_satuan * $jumlah_sepatu;
            $total_harga = $sub_total;

            if ($request->alamat_jemput) {
                User::where('id_user', $user->id_user)->update([
                    'alamat' => $request->alamat_jemput
                ]);
            }

            // 1. SIMPAN KE tr_reservasi (Kolom jumlah_sepatu dkk sudah dihapus)
            $reservasi = Reservasi::create([
                'id_user'             => $user->id_user,
                'tanggal_reservasi'   => now()->toDateString(),
                'metode_layanan'      => $request->metode_layanan, 
                'status'              => 'Menunggu Konfirmasi',
                'status_bayar'        => 'Belum Lunas', // Kolom Baru
                'total_harga'         => $total_harga,
                'alamat_jemput'       => $request->alamat_jemput,
            ]);

            $id_res_baru = $reservasi->id_reservasi ?? $reservasi->id; 

            // 2. SIMPAN KE tr_detail_reservasi (Kolom jumlah & sub_total dipindah ke sini)
            DetailReservasi::create([
                'id_reservasi' => $id_res_baru,
                'id_layanan'   => $request->id_layanan,
                'harga'        => $harga_satuan,
                'jumlah'       => $jumlah_sepatu, // Kolom Baru
                'sub_total'    => $sub_total,     // Kolom Baru
            ]);

            // 3. SIMPAN KE tr_pembayaran (Struktur Baru yang disederhanakan)
            $metode_bayar_db = ($request->metode_pembayaran == 'Payment Gateway') ? 'Payment Gateway' : 'Tunai';
            
            Pembayaran::create([
                'id_reservasi'  => $id_res_baru,
                'tanggal'       => null, // Diisi nanti saat lunas
                'jumlah'        => null, // Diisi nanti saat lunas
                'metode_bayar'  => $metode_bayar_db,
            ]);

            DB::commit();

            // LOGIKA MIDTRANS
            if ($request->metode_pembayaran == 'Payment Gateway') {
                // ✅ UPDATE: Menambahkan relasi 'pembayaran' saat selesai memproses pesanan
                $reservasiLengkap = Reservasi::with(['user', 'detail.layanan', 'pembayaran'])->find($id_res_baru);
                
                $snapToken = $this->generateMidtransToken($reservasiLengkap);

                return view('pelanggan.reservasi.pembayaran', [
                    'reservasi' => $reservasiLengkap,
                    'snapToken' => $snapToken
                ]);
            }

            return redirect()->route('reservasi.riwayat')->with('success', 'Reservasi berhasil! Silakan lakukan pembayaran di kasir kami.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['Gagal Menyimpan Data: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Fungsi Helper untuk membuat Snap Token Midtrans
     */
    private function generateMidtransToken($reservasi)
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = env('MIDTRANS_IS_SANITIZED', true);
        Config::$is3ds = env('MIDTRANS_IS_3DS', true);

        // Ambil data dari relasi Detail Reservasi (Struktur Baru)
        $detail = $reservasi->detail->first();
        
        $namaLayanan = $detail->layanan->nama_layanan ?? 'Jasa Cuci Sepatu';
        $idLayanan = $detail->id_layanan ?? '1';
        $hargaSatuan = $detail->harga ?? $reservasi->total_harga;
        $jumlahBeli = $detail->jumlah ?? 1;

        $params = array(
            'transaction_details' => array(
                'order_id' => $reservasi->id_reservasi . '-' . time(),
                'gross_amount' => $reservasi->total_harga,
            ),
            'customer_details' => array(
                'first_name' => $reservasi->user->nama ?? 'Pelanggan',
                'email'      => $reservasi->user->email ?? 'pelanggan@email.com',
                'phone'      => $reservasi->user->no_telp ?? '-',
            ),
            'item_details' => array(
                array(
                    'id'       => $idLayanan,
                    'price'    => $hargaSatuan,
                    'quantity' => $jumlahBeli,
                    'name'     => substr($namaLayanan, 0, 50) 
                )
            )
        );

        return Snap::getSnapToken($params);
    }

    /**
     * Fungsi Update Pengembalian
     */
    public function pilihPengembalian(Request $request, $id)
    {
        $request->validate([
            'metode'             => 'required|in:Ambil di Toko,Diantar ke Alamat',
            'wa_pengantaran'     => 'required_if:metode,Diantar ke Alamat|max:15',
            'alamat_pengantaran' => 'required_if:metode,Diantar ke Alamat|max:200', // Sesuai VARCHAR 200
        ]);

        $reservasi = Reservasi::where('id_reservasi', $id)
                    ->where('id_user', auth()->user()->id_user)
                    ->firstOrFail();

        DB::beginTransaction();

        try {
            // Karena metode_pengembalian dihapus, kita langsung update 'status' pesanan
            if ($request->metode == 'Diantar ke Alamat') {
                $reservasi->update([
                    'status'              => 'Menunggu Kurir',
                    'wa_pengantaran'      => $request->wa_pengantaran,
                    'alamat_pengantaran'  => $request->alamat_pengantaran,
                ]);
                $msg = 'Siap! Kurir akan segera mengantar sepatu Anda.';
            } else {
                $reservasi->update([
                    'status'              => 'Siap Diambil'
                ]);
                $msg = 'Silakan ambil sepatu Anda di toko kami.';
            }

            DB::commit();
            return redirect()->back()->with('success', $msg);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['Gagal: ' . $e->getMessage()]);
        }
    }

    /**
     * FUNGSI WEBHOOK / CALLBACK MIDTRANS
     */
    public function callback(Request $request)
    {
        $serverKey = env('MIDTRANS_SERVER_KEY');
        
        $order_id = $request->order_id;
        $status_code = $request->status_code;
        $gross_amount = $request->gross_amount;
        $transaction_status = $request->transaction_status;

        $hashed = hash("sha512", $order_id . $status_code . $gross_amount . $serverKey);
        
        if ($hashed == $request->signature_key) {
            $id_asli = explode('-', $order_id)[0];
            $reservasi = Reservasi::find($id_asli);
            $pembayaran = Pembayaran::where('id_reservasi', $id_asli)->first();

            if ($reservasi && $pembayaran) {
                DB::beginTransaction();
                try {
                    if ($transaction_status == 'capture' || $transaction_status == 'settlement') {
                        // LUNAS: Update status di tr_reservasi, dan isi data di tr_pembayaran
                        $reservasi->update([
                            'status' => 'Diproses',
                            'status_bayar' => 'Lunas' 
                        ]);
                        $pembayaran->update([
                            'tanggal' => now(),
                            'jumlah' => $gross_amount,
                            'metode_bayar' => 'Payment Gateway'
                        ]);
                    } else if ($transaction_status == 'pending') {
                        $reservasi->update(['status_bayar' => 'Belum Lunas']);
                    } else if ($transaction_status == 'deny' || $transaction_status == 'expire' || $transaction_status == 'cancel') {
                        $reservasi->update(['status' => 'Dibatalkan']);
                    }
                    
                    DB::commit();
                    Log::info("Callback Midtrans Berhasil: Order ID $order_id, Status $transaction_status");
                    return response()->json(['message' => 'Status diupdate'], 200);

                } catch (\Exception $e) {
                    DB::rollBack();
                    Log::error("Error update status Midtrans: " . $e->getMessage());
                    return response()->json(['message' => 'Gagal update'], 500);
                }
            }
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json(['message' => 'Signature tidak valid'], 403);
    }
}
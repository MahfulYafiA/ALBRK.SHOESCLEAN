<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'tr_reservasi';
    protected $primaryKey = 'id_reservasi';

    // ✅ UPDATE: Disesuaikan dengan revisi ERD Dosen
    // Dihapus: jumlah_sepatu, metode_pengembalian, status_pengambilan
    // Ditambah: status_bayar
    protected $fillable = [
        'id_user',
        'tanggal_reservasi',
        'metode_layanan',
        'alamat_jemput',
        'status',
        'status_bayar', // 🚨 Kolom baru untuk cek lunas/belum
        'total_harga',
        'wa_pengantaran',      
        'alamat_pengantaran'   
    ];

    /**
     * Relasi ke User (Pemilik Reservasi)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    /**
     * Relasi ke Detail Reservasi (Banyak Item/Jasa)
     * Diubah ke hasMany karena satu nota bisa banyak baris detail
     */
    public function detail()
    {
        return $this->hasMany(DetailReservasi::class, 'id_reservasi', 'id_reservasi');
    }

    /**
     * Relasi ke Pembayaran
     */
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_reservasi', 'id_reservasi');
    }

    /**
     * SOLUSI ERROR LAPORAN:
     * ✅ UPDATE PIVOT: Menambahkan 'jumlah' dan 'sub_total' 
     * agar bisa diambil di halaman laporan nanti.
     */
    public function layanan()
    {
        return $this->belongsToMany(Layanan::class, 'tr_detail_reservasi', 'id_reservasi', 'id_layanan')
                    ->withPivot('id_detail', 'harga', 'jumlah', 'sub_total'); // Membawa data dari tabel detail
    }
}
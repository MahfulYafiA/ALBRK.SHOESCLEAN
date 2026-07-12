<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // 1. Nama tabel sesuai ms_user di Workbench
    protected $table = 'ms_user';
    
    // 2. Primary Key bukan 'id', tapi 'id_user'
    protected $primaryKey = 'id_user';

    // 3. Timestamps harus TRUE karena di migrasi kita pakai $table->timestamps()
    public $timestamps = true; 

    // 4. Daftar kolom yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'nama',
        'email',
        'password',
        'id_role',    // ✅ DITAMBAHKAN KEMBALI agar Seeder bisa masuk
        'no_telp',
        'alamat',
        'foto_profil',
        'google_id',
    ];

    // 5. Sembunyikan data sensitif
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting tipe data otomatis
     */
    protected function casts(): array
    {
        return [
            // 🚨 'password' => 'hashed' DIHAPUS agar tidak terjadi Double Hash
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
}
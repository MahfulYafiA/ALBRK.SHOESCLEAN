<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tr_reservasi', function (Blueprint $table): void {
            if (! Schema::hasColumn('tr_reservasi', 'jumlah_sepatu')) {
                $table->unsignedTinyInteger('jumlah_sepatu')->default(1);
            }
            if (! Schema::hasColumn('tr_reservasi', 'metode_pengembalian')) {
                $table->string('metode_pengembalian', 20)->nullable();
            }
            if (! Schema::hasColumn('tr_reservasi', 'status_pengambilan')) {
                $table->string('status_pengambilan', 20)->nullable();
            }
            if (! Schema::hasColumn('tr_reservasi', 'nama_pelanggan')) {
                $table->string('nama_pelanggan', 100)->nullable();
            }
            if (! Schema::hasColumn('tr_reservasi', 'no_hp')) {
                $table->string('no_hp', 20)->nullable();
            }
            if (! Schema::hasColumn('tr_reservasi', 'jenis_sepatu')) {
                $table->string('jenis_sepatu', 100)->nullable();
            }
            if (! Schema::hasColumn('tr_reservasi', 'tanggal_bayar')) {
                $table->dateTime('tanggal_bayar')->nullable();
            }
            if (! Schema::hasColumn('tr_reservasi', 'metode_bayar')) {
                $table->string('metode_bayar', 50)->nullable();
            }
            if (! Schema::hasColumn('tr_reservasi', 'catatan')) {
                $table->text('catatan')->nullable();
            }
        });
    }

    public function down(): void
    {
        // These columns are part of the active application contract. Dropping them
        // on rollback could discard transaction history, so rollback is intentionally a no-op.
    }
};

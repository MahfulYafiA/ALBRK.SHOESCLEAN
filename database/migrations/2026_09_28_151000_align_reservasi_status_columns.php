<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tr_reservasi', function (Blueprint $table): void {
            $table->string('status', 30)->default('menunggu')->change();
            $table->string('metode_bayar', 50)->nullable()->change();
        });
    }

    public function down(): void
    {
        // Keep the application status values intact on rollback.
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tr_reservasi', function (Blueprint $table): void {
            if (! Schema::hasColumn('tr_reservasi', 'alamat_jemput')) {
                $table->text('alamat_jemput')->nullable();
            }

            if (! Schema::hasColumn('tr_reservasi', 'wa_pengantaran')) {
                $table->string('wa_pengantaran', 15)->nullable();
            }

            if (! Schema::hasColumn('tr_reservasi', 'alamat_pengantaran')) {
                $table->text('alamat_pengantaran')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('tr_reservasi', function (Blueprint $table): void {
            $columns = array_values(array_filter(
                ['alamat_jemput', 'wa_pengantaran', 'alamat_pengantaran'],
                fn (string $column): bool => Schema::hasColumn('tr_reservasi', $column),
            ));

            if ($columns !== []) {
                $table->dropColumn($columns);
            }
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // Legacy compatibility migration. Role is stored in ms_user.role per Workbench ERD.
    }

    public function down(): void
    {
        // Nothing to roll back.
    }
};

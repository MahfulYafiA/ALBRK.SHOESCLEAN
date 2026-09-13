<?php

namespace App\Repositories;

use App\Repositories\Contracts\SettingRepositoryInterface;
use Illuminate\Support\Facades\DB;

class SettingRepository implements SettingRepositoryInterface
{
    public function value(string $key): ?string
    {
        return DB::table('ms_pengaturan')->where('key', $key)->value('value');
    }

    public function set(string $key, string $value): void
    {
        DB::table('ms_pengaturan')->updateOrInsert(
            ['key' => $key],
            ['value' => $value, 'updated_at' => now()],
        );
    }
}

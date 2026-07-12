<?php

namespace App\ViewModels;

use App\Models\Layanan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class LandingPageViewModel
{
    public function toArray(): array
    {
        return [
            'layanans' => $this->layanans(),
            'heroPath' => $this->imageUrl('hero_image', 'images/adidasspezial.png'),
            'tentangPath' => $this->imageUrl('tentang_image', 'images/fototentangkami.jpeg'),
        ];
    }

    private function layanans()
    {
        if (! Schema::hasTable('ms_layanan')) {
            return collect();
        }

        return Layanan::orderBy('id_layanan')->get();
    }

    private function imageUrl(string $key, string $fallback): string
    {
        if (! Schema::hasTable('ms_pengaturan')) {
            return asset($fallback);
        }

        $path = DB::table('ms_pengaturan')->where('key', $key)->value('value');

        return $path && Storage::disk('public')->exists($path)
            ? route('media.public', ['path' => $path])
            : asset($fallback);
    }
}

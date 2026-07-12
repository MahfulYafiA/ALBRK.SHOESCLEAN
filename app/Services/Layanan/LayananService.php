<?php

namespace App\Services\Layanan;

use App\DTOs\LayananDTO;
use App\Models\Layanan;
use App\Repositories\Contracts\LayananRepositoryInterface;
use App\Services\Contracts\LayananServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LayananService implements LayananServiceInterface
{
    public function __construct(
        private LayananRepositoryInterface $layananRepository
    ) {}

    /**
     * Get all layanan
     */
    public function getAll(): Collection
    {
        return $this->layananRepository->getAll();
    }

    /**
     * Get layanan by ID
     */
    public function getById(int $id): ?Layanan
    {
        return $this->layananRepository->findById($id);
    }

    /**
     * Create new layanan
     */
    public function create(LayananDTO $dto): Layanan
    {
        return $this->layananRepository->create($dto->toArray());
    }

    /**
     * Update layanan
     */
    public function update(int $id, LayananDTO $dto): bool
    {
        return $this->layananRepository->update($id, $dto->toArray());
    }

    /**
     * Delete layanan
     */
    public function delete(int $id): bool
    {
        return $this->layananRepository->delete($id);
    }

    /**
     * Update hero banner image
     */
    public function updateHeroBanner(Request $request): bool
    {
        if (!$request->hasFile('hero_image')) {
            return false;
        }

        return DB::transaction(function () use ($request) {
            // Get old setting
            $oldSetting = DB::table('ms_pengaturan')
                ->where('key', 'hero_image')
                ->first();

            // Delete old file
            if ($oldSetting && $oldSetting->value) {
                Storage::disk('public')->delete($oldSetting->value);
            }

            // Store new file
            $path = $request->file('hero_image')->store('banners', 'public');

            // Update database
            DB::table('ms_pengaturan')->updateOrInsert(
                ['key' => 'hero_image'],
                [
                    'value' => $path,
                    'updated_at' => now()
                ]
            );

            return true;
        });
    }

    /**
     * Update tentang kami image
     */
    public function updateTentangKami(Request $request): bool
    {
        if (!$request->hasFile('tentang_image')) {
            return false;
        }

        return DB::transaction(function () use ($request) {
            // Get old setting
            $oldSetting = DB::table('ms_pengaturan')
                ->where('key', 'tentang_image')
                ->first();

            // Delete old file
            if ($oldSetting && $oldSetting->value) {
                Storage::disk('public')->delete($oldSetting->value);
            }

            // Store new file
            $path = $request->file('tentang_image')->store('banners', 'public');

            // Update database
            DB::table('ms_pengaturan')->updateOrInsert(
                ['key' => 'tentang_image'],
                [
                    'value' => $path,
                    'updated_at' => now()
                ]
            );

            return true;
        });
    }

    /**
     * Get hero image URL
     */
    public function getHeroImageUrl(): string
    {
        if (!DB::getSchemaBuilder()->hasTable('ms_pengaturan')) {
            return asset('images/adidasspezial.png');
        }

        $path = DB::table('ms_pengaturan')
            ->where('key', 'hero_image')
            ->value('value');

        return $path && Storage::disk('public')->exists($path)
            ? route('media.public', ['path' => $path])
            : asset('images/adidasspezial.png');
    }

    /**
     * Get tentang kami image URL
     */
    public function getTentangImageUrl(): string
    {
        if (!DB::getSchemaBuilder()->hasTable('ms_pengaturan')) {
            return asset('images/fototentangkami.jpeg');
        }

        $path = DB::table('ms_pengaturan')
            ->where('key', 'tentang_image')
            ->value('value');

        return $path && Storage::disk('public')->exists($path)
            ? route('media.public', ['path' => $path])
            : asset('images/fototentangkami.jpeg');
    }
}

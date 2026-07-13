<?php

namespace App\ViewModels\Admin;

use App\Backend\Models\Layanan;
use App\Backend\Services\Contracts\LayananServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LayananViewModel
{
    public function __construct(
        private LayananServiceInterface $layananService
    ) {}

    /**
     * Get all layanan
     */
    public function getAllLayanan(): Collection
    {
        return Layanan::orderBy('nama_layanan')->get();
    }

    /**
     * Create new layanan
     */
    public function createLayanan(Request $request): RedirectResponse
    {
        $result = $this->layananService->createLayanan($request->all());

        if ($result['success']) {
            return back()->with('success', $result['message']);
        }

        return back()->with('error', $result['message'])->withInput();
    }

    /**
     * Update layanan
     */
    public function updateLayanan(Request $request, int $id): RedirectResponse
    {
        $result = $this->layananService->updateLayanan($id, $request->all());

        if ($result['success']) {
            return back()->with('success', $result['message']);
        }

        return back()->with('error', $result['message']);
    }

    /**
     * Delete layanan
     */
    public function deleteLayanan(int $id): RedirectResponse
    {
        $result = $this->layananService->deleteLayanan($id);

        if ($result) {
            return back()->with('success', 'Layanan berhasil dihapus.');
        }

        return back()->with('error', 'Gagal menghapus layanan.');
    }

    /**
     * Update hero banner
     */
    public function updateHeroBanner(Request $request): RedirectResponse
    {
        // Validasi input
        if (!$request->hasFile('hero_image')) {
            return back()->with('error', 'Tidak ada file yang dipilih.');
        }

        $file = $request->file('hero_image');

        // Validasi file
        if (!$file->isValid()) {
            return back()->with('error', 'File upload tidak valid.');
        }

        $allowedMimes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
        if (!in_array($file->getMimeType(), $allowedMimes)) {
            return back()->with('error', 'Format file harus JPG, PNG, GIF, atau WebP.');
        }

        if ($file->getSize() > 2 * 1024 * 1024) {
            return back()->with('error', 'Ukuran file maksimal 2MB.');
        }

        try {
            // Hapus gambar lama jika ada
            $oldSetting = DB::table('ms_pengaturan')->where('key', 'hero_image')->first();
            if ($oldSetting && $oldSetting->value) {
                $oldPath = storage_path('app/public/' . $oldSetting->value);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            // Generate nama unik
            $filename = 'hero_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Simpan ke storage/app/public/images/
            $path = $file->storeAs('images', $filename, 'public');

            // Update atau create di database
            DB::table('ms_pengaturan')->updateOrInsert(
                ['key' => 'hero_image'],
                [
                    'value' => 'images/' . $filename,
                    'updated_at' => now()
                ]
            );

            return back()->with('success', 'Hero banner berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengupload banner: ' . $e->getMessage());
        }
    }

    /**
     * Update tentang kami
     */
    public function updateTentangKami(Request $request): RedirectResponse
    {
        if (!$request->hasFile('tentang_image')) {
            return back()->with('error', 'Tidak ada file yang dipilih.');
        }

        $file = $request->file('tentang_image');

        if (!$file->isValid()) {
            return back()->with('error', 'File upload tidak valid.');
        }

        $allowedMimes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
        if (!in_array($file->getMimeType(), $allowedMimes)) {
            return back()->with('error', 'Format file harus JPG, PNG, GIF, atau WebP.');
        }

        try {
            // Hapus gambar lama jika ada
            $oldSetting = DB::table('ms_pengaturan')->where('key', 'tentang_image')->first();
            if ($oldSetting && $oldSetting->value) {
                $oldPath = storage_path('app/public/' . $oldSetting->value);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            // Generate nama unik
            $filename = 'tentang_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Simpan ke storage/app/public/images/
            $path = $file->storeAs('images', $filename, 'public');

            // Update atau create di database
            DB::table('ms_pengaturan')->updateOrInsert(
                ['key' => 'tentang_image'],
                [
                    'value' => 'images/' . $filename,
                    'updated_at' => now()
                ]
            );

            return back()->with('success', 'Gambar tentang kami berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengupload gambar: ' . $e->getMessage());
        }
    }
}

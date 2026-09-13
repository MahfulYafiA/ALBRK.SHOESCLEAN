<?php

namespace App\ViewModels\Admin;

use App\Repositories\Contracts\LayananRepositoryInterface;
use App\Services\Contracts\LayananServiceInterface;
use App\Services\Contracts\SiteSettingServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LayananViewModel
{
    public function __construct(
        private LayananServiceInterface $layananService,
        private LayananRepositoryInterface $layananRepository,
        private SiteSettingServiceInterface $siteSettingService,
    ) {}

    /**
     * Get all layanan
     */
    public function getAllLayanan(): Collection
    {
        return $this->layananRepository->getAll();
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
        if (!$request->hasFile('hero_image')) {
            return back()->with('error', 'Tidak ada file yang dipilih.');
        }

        $result = $this->siteSettingService->updateImage('hero_image', 'hero', $request->file('hero_image'));

        return $result['success']
            ? back()->with('success', 'Hero banner berhasil diperbarui!')
            : back()->with('error', $result['message']);
    }

    /**
     * Update tentang kami
     */
    public function updateTentangKami(Request $request): RedirectResponse
    {
        if (!$request->hasFile('tentang_image')) {
            return back()->with('error', 'Tidak ada file yang dipilih.');
        }

        $result = $this->siteSettingService->updateImage('tentang_image', 'tentang', $request->file('tentang_image'));

        return $result['success']
            ? back()->with('success', 'Gambar tentang kami berhasil diperbarui!')
            : back()->with('error', $result['message']);
    }
}

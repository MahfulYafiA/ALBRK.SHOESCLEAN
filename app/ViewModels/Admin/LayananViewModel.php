<?php

namespace App\ViewModels\Admin;

use App\DTOs\LayananDTO;
use App\Http\Requests\Layanan\StoreLayananRequest;
use App\Http\Requests\Layanan\UpdateLayananRequest;
use App\Models\Layanan;
use App\Repositories\Contracts\LayananRepositoryInterface;
use App\Services\Contracts\LayananServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class LayananViewModel
{
    public function __construct(
        private LayananRepositoryInterface $layananRepository,
        private LayananServiceInterface $layananService
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
    public function createLayanan(StoreLayananRequest $request): RedirectResponse
    {
        try {
            $gambar = null;
            if ($request->hasFile('gambar')) {
                $gambar = $request->file('gambar')->store('layanans', 'public');
            }

            $dto = LayananDTO::fromRequest($request->validated(), $gambar);
            $this->layananService->create($dto);

            return redirect()->back()->with('success', 'Layanan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan layanan.');
        }
    }

    /**
     * Update layanan
     */
    public function updateLayanan(UpdateLayananRequest $request, int $id): RedirectResponse
    {
        $layanan = $this->layananRepository->findById($id);

        if (!$layanan) {
            return redirect()->back()->with('error', 'Layanan tidak ditemukan.');
        }

        try {
            $gambar = $layanan->gambar;
            if ($request->hasFile('gambar')) {
                // Delete old image
                if ($layanan->gambar) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($layanan->gambar);
                }
                $gambar = $request->file('gambar')->store('layanans', 'public');
            }

            $dto = LayananDTO::fromRequest($request->validated(), $gambar);
            $this->layananService->update($id, $dto);

            return redirect()->back()->with('success', 'Layanan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui layanan.');
        }
    }

    /**
     * Delete layanan
     */
    public function deleteLayanan(int $id): RedirectResponse
    {
        $layanan = $this->layananRepository->findById($id);

        if (!$layanan) {
            return redirect()->back()->with('error', 'Layanan tidak ditemukan.');
        }

        try {
            $this->layananService->delete($id);
            return redirect()->back()->with('success', 'Layanan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus layanan.');
        }
    }

    /**
     * Update hero banner
     */
    public function updateHeroBanner(Request $request): RedirectResponse
    {
        try {
            $this->layananService->updateHeroBanner($request);
            return redirect()->back()->with('success', 'Banner berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui banner.');
        }
    }

    /**
     * Update tentang kami image
     */
    public function updateTentangKami(Request $request): RedirectResponse
    {
        try {
            $this->layananService->updateTentangKami($request);
            return redirect()->back()->with('success', 'Gambar berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui gambar.');
        }
    }
}

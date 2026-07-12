<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Layanan\StoreLayananRequest;
use App\Http\Requests\Layanan\UpdateLayananRequest;
use App\ViewModels\Admin\LayananViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LayananController extends Controller
{
    public function __construct(
        private LayananViewModel $layananViewModel
    ) {}

    /**
     * Show layanan list
     */
    public function index(): View
    {
        $layanans = $this->layananViewModel->getAllLayanan();

        // Check if superadmin
        if (auth()->user()->id_role === 1) {
            return view('superadmin.layanan', compact('layanans'));
        }

        return view('admin.layanan', compact('layanans'));
    }

    /**
     * Store new layanan
     */
    public function store(StoreLayananRequest $request): RedirectResponse
    {
        return $this->layananViewModel->createLayanan($request);
    }

    /**
     * Update layanan
     */
    public function update(UpdateLayananRequest $request, int $id): RedirectResponse
    {
        return $this->layananViewModel->updateLayanan($request, $id);
    }

    /**
     * Delete layanan
     */
    public function destroy(int $id): RedirectResponse
    {
        return $this->layananViewModel->deleteLayanan($id);
    }

    /**
     * Update hero banner
     */
    public function updateHero(Request $request): RedirectResponse
    {
        return $this->layananViewModel->updateHeroBanner($request);
    }

    /**
     * Update tentang kami image
     */
    public function updateTentang(Request $request): RedirectResponse
    {
        return $this->layananViewModel->updateTentangKami($request);
    }
}

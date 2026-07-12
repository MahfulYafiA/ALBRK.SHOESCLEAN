<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Layanan\StoreLayananRequest;
use App\Http\Requests\Layanan\UpdateLayananRequest;
use App\ViewModels\Admin\LayananViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SuperAdminLayananController extends Controller
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
        return view('superadmin.layanan', compact('layanans'));
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
}

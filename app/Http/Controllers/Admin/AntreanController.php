<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Backend\Http\Requests\Admin\UpdateStatusRequest;
use App\ViewModels\Admin\AntreanViewModel;
use App\ViewModels\Admin\DashboardViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AntreanController extends Controller
{
    public function __construct(
        private AntreanViewModel $antreanViewModel,
        private DashboardViewModel $dashboardViewModel
    ) {}

    /**
     * Show antrean page
     */
    public function index(): View
    {
        $reservasis = $this->antreanViewModel->getAntrean();
        $stats = $this->dashboardViewModel->getDashboardData();

        return view('admin.antrean', compact('reservasis', 'stats'));
    }

    /**
     * Update reservation status
     */
    public function updateStatus(UpdateStatusRequest $request, int $id): RedirectResponse
    {
        $result = $this->antreanViewModel->updateStatus($id, $request->status);

        if ($result['success']) {
            return back()->with('success', $result['message']);
        }

        return back()->with('error', $result['message']);
    }

    /**
     * Delete reservation
     */
    public function destroy(int $id): RedirectResponse
    {
        $result = $this->antreanViewModel->deleteReservasi($id);

        if ($result) {
            return back()->with('success', 'Reservasi berhasil dihapus.');
        }

        return back()->with('error', 'Gagal menghapus reservasi.');
    }
}

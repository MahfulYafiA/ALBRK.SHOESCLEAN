<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ViewModels\Admin\AntreanViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AntreanController extends Controller
{
    public function __construct(
        private AntreanViewModel $antreanViewModel
    ) {}

    /**
     * Show antrean list
     */
    public function index(): View
    {
        $reservasis = $this->antreanViewModel->getAntreanList();
        return view('admin.antrean', compact('reservasis'));
    }

    /**
     * Update reservasi status
     */
    public function updateStatus(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'status' => 'required|in:Diajukan,Diproses,Selesai,Dibatalkan',
        ]);

        return $this->antreanViewModel->updateStatus($request, $id);
    }

    /**
     * Delete reservasi
     */
    public function destroy(int $id): RedirectResponse
    {
        return $this->antreanViewModel->deleteReservasi($id);
    }
}

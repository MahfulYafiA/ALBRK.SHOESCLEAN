<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ViewModels\Admin\LaporanViewModel;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaporanController extends Controller
{
    public function __construct(
        private LaporanViewModel $laporanViewModel
    ) {}

    /**
     * Show laporan page
     */
    public function index(Request $request): View
    {
        $data = $this->laporanViewModel->getLaporanData($request);

        // Check if superadmin
        if (auth()->user()->id_role === 1) {
            return view('superadmin.laporan', $data);
        }

        return view('admin.laporan', $data);
    }
}

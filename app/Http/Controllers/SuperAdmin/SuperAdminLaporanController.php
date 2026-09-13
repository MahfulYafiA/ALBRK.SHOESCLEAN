<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\ViewModels\Admin\LaporanViewModel;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SuperAdminLaporanController extends Controller
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
        return view('superadmin.laporan', $data);
    }
}

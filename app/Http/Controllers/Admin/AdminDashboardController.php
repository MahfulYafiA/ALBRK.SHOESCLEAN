<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAdminRequest;
use App\Http\Requests\Admin\UpdateStatusRequest;
use App\Http\Requests\Layanan\StoreLayananRequest;
use App\Http\Requests\Layanan\UpdateLayananRequest;
use App\ViewModels\Admin\AntreanViewModel;
use App\ViewModels\Admin\DashboardViewModel;
use App\ViewModels\Admin\LayananViewModel;
use App\ViewModels\Admin\LaporanViewModel;
use App\ViewModels\Admin\UserManagementViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function __construct(
        private DashboardViewModel $dashboardViewModel
    ) {}

    /**
     * Show admin dashboard
     */
    public function dashboard(): View
    {
        $data = $this->dashboardViewModel->getDashboardData();
        return view('admin.dashboard', $data);
    }
}

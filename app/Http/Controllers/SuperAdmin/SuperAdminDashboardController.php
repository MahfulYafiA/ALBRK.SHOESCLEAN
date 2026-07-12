<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAdminRequest;
use App\ViewModels\Admin\DashboardViewModel;
use App\ViewModels\Admin\LaporanViewModel;
use App\ViewModels\Admin\UserManagementViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SuperAdminDashboardController extends Controller
{
    public function __construct(
        private DashboardViewModel $dashboardViewModel
    ) {}

    /**
     * Show superadmin dashboard
     */
    public function dashboard(): View
    {
        $data = $this->dashboardViewModel->getDashboardData();
        return view('superadmin.dashboard', $data);
    }
}

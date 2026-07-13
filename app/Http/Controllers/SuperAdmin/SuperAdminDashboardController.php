<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\ViewModels\Admin\DashboardViewModel;
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
        $stats = $this->dashboardViewModel->getDashboardData();
        return view('superadmin.dashboard', compact('stats'));
    }
}

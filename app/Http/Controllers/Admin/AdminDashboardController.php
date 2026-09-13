<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ViewModels\Admin\DashboardViewModel;
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
        $stats = $this->dashboardViewModel->getDashboardData();
        return view('admin.dashboard', compact('stats'));
    }
}

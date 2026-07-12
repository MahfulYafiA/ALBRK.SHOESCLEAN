<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAdminRequest;
use App\ViewModels\Admin\UserManagementViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SuperAdminUserController extends Controller
{
    public function __construct(
        private UserManagementViewModel $userManagementViewModel
    ) {}

    /**
     * Show users list (including admins and superadmins)
     */
    public function index(): View
    {
        // Get all users (role 2 and 3)
        $admins = $this->userManagementViewModel->getUsersByRole(2);
        $pelanggans = $this->userManagementViewModel->getUsersByRole(3);

        return view('superadmin.users', [
            'admins' => $admins,
            'pelanggans' => $pelanggans,
        ]);
    }

    /**
     * Store new admin/superadmin
     */
    public function store(StoreAdminRequest $request): RedirectResponse
    {
        return $this->userManagementViewModel->createAdmin($request);
    }

    /**
     * Delete user
     */
    public function destroy(int $id): RedirectResponse
    {
        return $this->userManagementViewModel->deleteUser($id);
    }
}

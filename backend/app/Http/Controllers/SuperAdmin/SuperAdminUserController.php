<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Backend\Http\Requests\Admin\StoreAdminRequest;
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
        $users = $this->userManagementViewModel->getAllUsers();

        $admins = $users->where('role', 'admin')->values();
        $pelanggans = $users->where('role', 'pelanggan')->values();

        return view('superadmin.users', [
            'users' => $users,
            'admins' => $admins,
            'pelanggans' => $pelanggans,
        ]);
    }

    /**
     * Store new admin/superadmin
     */
    public function store(StoreAdminRequest $request): RedirectResponse
    {
        return $this->userManagementViewModel->createUser($request);
    }

    /**
     * Delete user
     */
    public function destroy(int $id): RedirectResponse
    {
        return $this->userManagementViewModel->deleteUser($id);
    }
}

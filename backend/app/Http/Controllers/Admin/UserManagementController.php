<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Backend\Http\Requests\Admin\StoreAdminRequest;
use App\ViewModels\Admin\UserManagementViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserManagementController extends Controller
{
    public function __construct(
        private UserManagementViewModel $userManagementViewModel
    ) {}

    /**
     * Show users page
     */
    public function index(): View
    {
        $users = $this->userManagementViewModel->getAllUsers();

        $pelanggan = $users->where('role', 'pelanggan')->values();

        return view('admin.users', ['users' => $pelanggan, 'pelanggan' => $pelanggan]);
    }

    /**
     * Store new user
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

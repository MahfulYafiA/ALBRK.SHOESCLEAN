<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAdminRequest;
use App\ViewModels\Admin\UserManagementViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserManagementController extends Controller
{
    public function __construct(
        private UserManagementViewModel $userManagementViewModel
    ) {}

    /**
     * Show users list
     */
    public function index(): View
    {
        $users = $this->userManagementViewModel->getUsersByRole(3);
        return view('admin.users', compact('users'));
    }

    /**
     * Store new admin
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

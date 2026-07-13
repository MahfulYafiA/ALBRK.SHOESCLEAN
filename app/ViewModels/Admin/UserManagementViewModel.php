<?php

namespace App\ViewModels\Admin;

use App\Backend\Models\User;
use App\Backend\Services\Contracts\UserServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserManagementViewModel
{
    public function __construct(
        private UserServiceInterface $userService
    ) {}

    /**
     * Get all users by role
     */
    public function getAllUsers(): Collection
    {
        return User::orderBy('created_at', 'desc')->get();
    }

    /**
     * Create new user
     */
    public function createUser(Request $request): RedirectResponse
    {
        $result = $this->userService->createUser($request->all());

        if ($result['success']) {
            return back()->with('success', $result['message']);
        }

        return back()->with('error', $result['message'])->withInput();
    }

    /**
     * Delete user
     */
    public function deleteUser(int $id): RedirectResponse
    {
        // Prevent deleting own account
        if ($id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $result = $this->userService->deleteUser($id);

        if ($result) {
            return back()->with('success', 'User berhasil dihapus.');
        }

        return back()->with('error', 'Gagal menghapus user.');
    }
}

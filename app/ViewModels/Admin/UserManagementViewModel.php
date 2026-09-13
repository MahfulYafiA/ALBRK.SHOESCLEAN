<?php

namespace App\ViewModels\Admin;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserManagementViewModel
{
    public function __construct(
        private UserServiceInterface $userService,
        private UserRepositoryInterface $userRepository,
    ) {}

    /**
     * Get all users by role
     */
    public function getAllUsers(): Collection
    {
        return $this->userRepository->getAll();
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
     * Update user
     */
    public function updateUser(int $id, Request $request): RedirectResponse
    {
        $result = $this->userService->updateUser($id, $request->all());

        if ($result['success']) {
            return back()->with('success', $result['message']);
        }

        return back()->with('error', $result['message'])->withInput();
    }

    /**
     * Toggle user status (aktif/nonaktif)
     */
    public function toggleUserStatus(int $id): RedirectResponse
    {
        $user = $this->userRepository->findById($id);

        if (!$user) {
            return back()->with('error', 'User tidak ditemukan.');
        }

        if ($user->id_role === 1) {
            return back()->with('error', 'Superadmin tidak dapat dinonaktifkan.');
        }

        $newStatus = $user->status === 'Aktif' ? 'Nonaktif' : 'Aktif';
        $this->userRepository->update($user, ['status' => $newStatus]);

        return back()->with('success', "User berhasil di{$newStatus}kan.");
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

        $user = $this->userRepository->findById($id);
        if ($user && $user->id_role === 1) {
            return back()->with('error', 'Superadmin tidak dapat dihapus.');
        }

        $result = $this->userService->deleteUser($id);

        if ($result) {
            return back()->with('success', 'User berhasil dihapus.');
        }

        return back()->with('error', 'Gagal menghapus user.');
    }
}

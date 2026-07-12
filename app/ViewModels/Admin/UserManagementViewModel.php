<?php

namespace App\ViewModels\Admin;

use App\Http\Requests\Admin\StoreAdminRequest;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;

class UserManagementViewModel
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private UserServiceInterface $userService
    ) {}

    /**
     * Get all users by role
     */
    public function getUsersByRole(int $roleId): Collection
    {
        return $this->userRepository->getByRole($roleId);
    }

    /**
     * Get all admin users (role 2)
     */
    public function getAdminUsers(): Collection
    {
        return $this->userRepository->getAllAdmin();
    }

    /**
     * Create new admin user
     */
    public function createAdmin(StoreAdminRequest $request): RedirectResponse
    {
        try {
            $dto = new \App\DTOs\UserDTO(
                nama: $request->nama,
                email: $request->email,
                password: bcrypt($request->password),
                idRole: (int) $request->id_role,
                noTelp: $request->no_telp
            );

            $this->userService->createAdmin($dto);

            return redirect()->back()->with('success', 'Akun admin berhasil dibuat.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat akun admin.');
        }
    }

    /**
     * Delete user
     */
    public function deleteUser(int $userId): RedirectResponse
    {
        $user = $this->userRepository->findById($userId);

        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }

        // Prevent self-delete
        if ($user->id_user === auth()->id()) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        try {
            $this->userService->deleteUserWithRelations($user);
            return redirect()->back()->with('success', 'User berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus user.');
        }
    }
}

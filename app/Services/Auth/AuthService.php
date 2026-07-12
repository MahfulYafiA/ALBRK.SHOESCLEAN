<?php

namespace App\Services\Auth;

use App\DTOs\UserDTO;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Services\Contracts\AuthServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthService implements AuthServiceInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    /**
     * Attempt to login user
     */
    public function attemptLogin(string $email, string $password): ?User
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return Auth::user();
        }
        return null;
    }

    /**
     * Register new user
     */
    public function register(UserDTO $dto): User
    {
        return $this->userRepository->create($dto->toArray());
    }

    /**
     * Handle Google OAuth callback
     */
    public function handleGoogleCallback(array $googleUser): User
    {
        $existingUser = $this->userRepository->findByEmail($googleUser['email']);

        if ($existingUser) {
            // Update google_id if not set
            if (!$existingUser->google_id) {
                $this->userRepository->update($existingUser->id_user, [
                    'google_id' => $googleUser['id'] ?? null
                ]);
            }
            return $existingUser;
        }

        // Create new user from Google data
        $dto = UserDTO::fromGoogleUser($googleUser);
        return $this->userRepository->create($dto->toArray());
    }

    /**
     * Get redirect based on user role
     */
    public function getRedirectBasedOnRole(User $user): RedirectResponse
    {
        $role = $user->id_role;

        return match($role) {
            1 => redirect()->route('superadmin.dashboard'),
            2 => redirect()->route('admin.dashboard'),
            default => redirect()->route('pelanggan.dashboard'),
        };
    }

    /**
     * Logout user
     */
    public function logout(): void
    {
        Auth::logout();
    }
}

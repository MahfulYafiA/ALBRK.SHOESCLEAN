<?php

namespace App\Services\Contracts;

use App\DTOs\UserDTO;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

interface AuthServiceInterface
{
    /**
     * Attempt to login user
     */
    public function attemptLogin(string $email, string $password): ?User;

    /**
     * Register new user
     */
    public function register(UserDTO $dto): User;

    /**
     * Handle Google OAuth callback
     */
    public function handleGoogleCallback(array $googleUser): User;

    /**
     * Get redirect based on user role
     */
    public function getRedirectBasedOnRole(User $user): RedirectResponse;

    /**
     * Logout user
     */
    public function logout(): void;
}

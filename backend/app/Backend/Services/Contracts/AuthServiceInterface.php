<?php

namespace App\Backend\Services\Contracts;

interface AuthServiceInterface
{
    /**
     * Attempt to login user
     */
    public function attemptLogin(string $email, string $password): ?array;

    /**
     * Register new user
     */
    public function register(array $data): array;

    /**
     * Handle Google login/registration
     */
    public function handleGoogleCallback(array $googleUser): array;

    /**
     * Logout user
     */
    public function logout(): void;
}

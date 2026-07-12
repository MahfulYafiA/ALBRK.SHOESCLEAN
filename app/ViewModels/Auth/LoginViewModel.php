<?php

namespace App\ViewModels\Auth;

use App\DTOs\UserDTO;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Services\Contracts\AuthServiceInterface;
use Illuminate\Http\RedirectResponse;

class LoginViewModel
{
    public function __construct(
        private AuthServiceInterface $authService
    ) {}

    /**
     * Attempt login
     */
    public function attemptLogin(LoginRequest $request): ?RedirectResponse
    {
        $user = $this->authService->attemptLogin(
            $request->email,
            $request->password
        );

        if (!$user) {
            return redirect()->back()
                ->withInput(['email' => $request->email])
                ->withErrors(['email' => 'Email atau password salah.']);
        }

        return $this->authService->getRedirectBasedOnRole($user);
    }

    /**
     * Handle Google OAuth callback
     */
    public function handleGoogleCallback(array $googleUser): RedirectResponse
    {
        $user = $this->authService->handleGoogleCallback($googleUser);

        // Auto login the user
        auth()->login($user);

        return $this->authService->getRedirectBasedOnRole($user);
    }
}

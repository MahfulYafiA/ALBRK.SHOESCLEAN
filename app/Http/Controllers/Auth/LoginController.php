<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Contracts\AuthServiceInterface;
use App\ViewModels\Auth\LoginViewModel;
use App\ViewModels\Auth\RegisterViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function __construct(
        private LoginViewModel $loginViewModel,
        private RegisterViewModel $registerViewModel,
        private AuthServiceInterface $authService
    ) {}

    /**
     * Show login form
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle login
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        return $this->loginViewModel->attemptLogin($request);
    }

    /**
     * Show register form
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle registration
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        return $this->registerViewModel->register($request);
    }

    /**
     * Redirect to Google
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google callback
     */
    public function handleGoogleCallback(): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $userData = [
                'id' => $googleUser->getId(),
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
            ];

            return $this->loginViewModel->handleGoogleCallback($userData);
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Login dengan Google gagal. Silakan coba lagi.');
        }
    }

    /**
     * Handle logout
     */
    public function logout(): RedirectResponse
    {
        $this->authService->logout();
        return redirect()->route('landing')->with('success', 'Anda telah logout.');
    }
}

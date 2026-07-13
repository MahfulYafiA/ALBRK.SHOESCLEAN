<?php

namespace App\ViewModels\Auth;

use App\Backend\Services\Contracts\AuthServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginViewModel
{
    public function __construct(
        private AuthServiceInterface $authService
    ) {}

    /**
     * Attempt to login
     */
    public function attemptLogin(Request $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        $result = $this->authService->attemptLogin($credentials['email'], $credentials['password']);

        if ($result) {
            $user = $result['user'];

            if ($user->isSuperAdmin()) {
                return redirect()->route('superadmin.dashboard')->with('success', 'Selamat datang, ' . $user->nama . '!');
            } elseif ($user->isAdmin()) {
                return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, ' . $user->nama . '!');
            }

            return redirect()->route('pelanggan.dashboard')->with('success', 'Selamat datang, ' . $user->nama . '!');
        }

        return back()->with('error', 'Email atau password salah.')->withInput($request->only('email'));
    }

    /**
     * Handle Google callback
     */
    public function handleGoogleCallback(array $userData): RedirectResponse
    {
        $result = $this->authService->handleGoogleCallback($userData);

        if ($result['user']) {
            $user = $result['user'];

            if ($user->isSuperAdmin()) {
                return redirect()->route('superadmin.dashboard')->with('success', $result['message']);
            } elseif ($user->isAdmin()) {
                return redirect()->route('admin.dashboard')->with('success', $result['message']);
            }

            return redirect()->route('pelanggan.dashboard')->with('success', $result['message']);
        }

        return redirect()->route('login')->with('error', 'Login dengan Google gagal.');
    }
}

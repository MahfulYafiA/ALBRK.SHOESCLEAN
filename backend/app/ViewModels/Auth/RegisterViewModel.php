<?php

namespace App\ViewModels\Auth;

use App\Backend\Services\Contracts\AuthServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RegisterViewModel
{
    public function __construct(
        private AuthServiceInterface $authService
    ) {}

    /**
     * Register new user
     */
    public function register(Request $request): RedirectResponse
    {
        $result = $this->authService->register($request->validated());

        if ($result['user']) {
            return redirect()->route('pelanggan.dashboard')->with('success', 'Registrasi berhasil! Selamat datang, ' . $result['user']->nama . '!');
        }

        return back()->with('error', 'Registrasi gagal. Silakan coba lagi.')->withInput();
    }
}

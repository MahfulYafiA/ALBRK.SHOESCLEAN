<?php

namespace App\ViewModels\Auth;

use App\DTOs\UserDTO;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Contracts\AuthServiceInterface;
use Illuminate\Http\RedirectResponse;

class RegisterViewModel
{
    public function __construct(
        private AuthServiceInterface $authService
    ) {}

    /**
     * Register new user
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        $dto = UserDTO::fromRegisterRequest($request->validated());
        $user = $this->authService->register($dto);

        // Auto login after registration
        auth()->login($user);

        return redirect()->route('pelanggan.dashboard')
            ->with('success', 'Registrasi berhasil! Selamat datang di ROFF SHOECLEAN.');
    }
}

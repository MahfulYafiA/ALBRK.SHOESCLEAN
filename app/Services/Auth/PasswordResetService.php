<?php

namespace App\Services\Auth;

use App\Services\Contracts\PasswordResetServiceInterface;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class PasswordResetService implements PasswordResetServiceInterface
{
    public function sendResetLink(string $email): bool
    {
        return Password::sendResetLink(['email' => $email]) === Password::RESET_LINK_SENT;
    }

    public function reset(array $credentials): bool
    {
        return Password::reset($credentials, function ($user, $password): void {
            $user->forceFill([
                'password' => Hash::make($password),
            ])->setRememberToken(Str::random(60));

            $user->save();
            event(new PasswordReset($user));
        }) === Password::PASSWORD_RESET;
    }
}

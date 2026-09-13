<?php

namespace App\Services\Contracts;

interface PasswordResetServiceInterface
{
    public function sendResetLink(string $email): bool;

    public function reset(array $credentials): bool;
}

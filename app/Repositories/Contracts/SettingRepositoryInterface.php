<?php

namespace App\Repositories\Contracts;

interface SettingRepositoryInterface
{
    public function value(string $key): ?string;

    public function set(string $key, string $value): void;
}

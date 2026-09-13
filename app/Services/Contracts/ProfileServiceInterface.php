<?php

namespace App\Services\Contracts;

use App\Models\User;
use Illuminate\Http\UploadedFile;

interface ProfileServiceInterface
{
    public function updateProfile(User $user, array $data): User;

    public function updatePhoto(User $user, UploadedFile $photo): User;

    public function updatePassword(User $user, string $currentPassword, string $newPassword): bool;

    public function deletePhoto(User $user): User;
}

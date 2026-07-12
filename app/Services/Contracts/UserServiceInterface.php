<?php

namespace App\Services\Contracts;

use App\DTOs\UserDTO;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

interface UserServiceInterface
{
    /**
     * Create admin user
     */
    public function createAdmin(UserDTO $dto): User;

    /**
     * Delete user with cascade relations
     */
    public function deleteUserWithRelations(User $user): bool;

    /**
     * Update user profile
     */
    public function updateProfile(User $user, array $data): bool;

    /**
     * Update user photo
     */
    public function updatePhoto(User $user, Request $request): bool;

    /**
     * Delete user photo
     */
    public function deletePhoto(User $user): bool;

    /**
     * Update user password
     */
    public function updatePassword(User $user, string $newPassword): bool;

    /**
     * Update pickup address
     */
    public function updatePickupAddress(User $user, string $alamat): bool;
}

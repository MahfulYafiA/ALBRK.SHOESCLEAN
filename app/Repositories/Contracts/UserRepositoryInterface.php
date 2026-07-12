<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    /**
     * Find user by ID
     */
    public function findById(int $id): ?User;

    /**
     * Find user by email
     */
    public function findByEmail(string $email): ?User;

    /**
     * Find user by Google ID
     */
    public function findByGoogleId(string $googleId): ?User;

    /**
     * Create new user
     */
    public function create(array $data): User;

    /**
     * Update user
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete user
     */
    public function delete(int $id): bool;

    /**
     * Get all customers (role = 3)
     */
    public function getAllPelanggan(): Collection;

    /**
     * Get all admins (role = 2)
     */
    public function getAllAdmin(): Collection;

    /**
     * Get all users by role
     */
    public function getByRole(int $roleId): Collection;

    /**
     * Update pickup address
     */
    public function updatePickupAddress(User $user, string $alamat): bool;
}

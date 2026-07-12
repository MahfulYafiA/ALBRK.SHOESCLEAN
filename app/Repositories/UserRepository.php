<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Find user by ID
     */
    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    /**
     * Find user by email
     */
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    /**
     * Find user by Google ID
     */
    public function findByGoogleId(string $googleId): ?User
    {
        return User::where('google_id', $googleId)->first();
    }

    /**
     * Create new user
     */
    public function create(array $data): User
    {
        return User::create($data);
    }

    /**
     * Update user
     */
    public function update(int $id, array $data): bool
    {
        $user = $this->findById($id);
        if (!$user) {
            return false;
        }
        return $user->update($data);
    }

    /**
     * Delete user
     */
    public function delete(int $id): bool
    {
        $user = $this->findById($id);
        if (!$user) {
            return false;
        }
        return $user->delete();
    }

    /**
     * Get all customers (role = 3)
     */
    public function getAllPelanggan(): Collection
    {
        return User::where('id_role', 3)->get();
    }

    /**
     * Get all admins (role = 2)
     */
    public function getAllAdmin(): Collection
    {
        return User::where('id_role', 2)->get();
    }

    /**
     * Get all users by role
     */
    public function getByRole(int $roleId): Collection
    {
        return User::where('id_role', $roleId)->get();
    }

    /**
     * Update pickup address
     */
    public function updatePickupAddress(User $user, string $alamat): bool
    {
        return $user->update(['alamat' => $alamat]);
    }
}

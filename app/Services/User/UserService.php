<?php

namespace App\Services\User;

use App\DTOs\UserDTO;
use App\Models\User;
use App\Repositories\Contracts\PembayaranRepositoryInterface;
use App\Repositories\Contracts\ReservasiRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserService implements UserServiceInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private ReservasiRepositoryInterface $reservasiRepository,
        private PembayaranRepositoryInterface $pembayaranRepository
    ) {}

    /**
     * Create admin user
     */
    public function createAdmin(UserDTO $dto): User
    {
        return $this->userRepository->create($dto->toArray());
    }

    /**
     * Delete user with cascade relations
     */
    public function deleteUserWithRelations(User $user): bool
    {
        return DB::transaction(function () use ($user) {
            // Get all reservasi for this user
            $reservasis = $this->reservasiRepository->getByUserId($user->id_user);

            foreach ($reservasis as $reservasi) {
                // Delete pembayaran
                $this->pembayaranRepository->deleteByReservasiId($reservasi->id_reservasi);

                // Delete detail reservasi
                $reservasi->detail()->delete();

                // Delete reservasi
                $this->reservasiRepository->delete($reservasi->id_reservasi);
            }

            // Delete user photo if exists
            if ($user->foto_profil) {
                Storage::disk('public')->delete($user->foto_profil);
            }

            // Delete user
            return $this->userRepository->delete($user->id_user);
        });
    }

    /**
     * Update user profile
     */
    public function updateProfile(User $user, array $data): bool
    {
        $updateData = [];

        if (isset($data['nama'])) {
            $updateData['nama'] = $data['nama'];
        }
        if (isset($data['no_telp'])) {
            $updateData['no_telp'] = $data['no_telp'];
        }
        if (isset($data['alamat'])) {
            $updateData['alamat'] = $data['alamat'];
        }

        return $this->userRepository->update($user->id_user, $updateData);
    }

    /**
     * Update user photo
     */
    public function updatePhoto(User $user, Request $request): bool
    {
        if (!$request->hasFile('foto_profil')) {
            return false;
        }

        // Delete old photo
        if ($user->foto_profil) {
            Storage::disk('public')->delete($user->foto_profil);
        }

        // Store new photo
        $path = $request->file('foto_profil')->store('photos', 'public');

        return $this->userRepository->update($user->id_user, ['foto_profil' => $path]);
    }

    /**
     * Delete user photo
     */
    public function deletePhoto(User $user): bool
    {
        if (!$user->foto_profil) {
            return false;
        }

        // Delete file
        Storage::disk('public')->delete($user->foto_profil);

        // Update database
        return $this->userRepository->update($user->id_user, ['foto_profil' => null]);
    }

    /**
     * Update user password
     */
    public function updatePassword(User $user, string $newPassword): bool
    {
        return $this->userRepository->update($user->id_user, [
            'password' => bcrypt($newPassword)
        ]);
    }

    /**
     * Update pickup address
     */
    public function updatePickupAddress(User $user, string $alamat): bool
    {
        return $this->userRepository->updatePickupAddress($user, $alamat);
    }
}

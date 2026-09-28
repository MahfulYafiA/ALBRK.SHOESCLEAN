<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\UpdatePasswordRequest;
use App\Http\Requests\Profile\UpdateProfilePhotoRequest;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Services\Contracts\ProfileServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct(private ProfileServiceInterface $profileService) {}

    public function index()
    {
        return view('profil.index', ['user' => Auth::user()]);
    }

    public function foto()
    {
        $path = Auth::user()->foto_profil;
        abort_unless($path && Storage::disk('public')->exists($path), 404);

        return response()->file(Storage::disk('public')->path($path));
    }

    public function update(UpdateProfileRequest $request)
    {
        $this->profileService->updateProfile(Auth::user(), $request->validated());

        return back()->with('success', 'Informasi profil berhasil diperbarui!');
    }

    public function updateFoto(UpdateProfilePhotoRequest $request)
    {
        $this->profileService->updatePhoto(Auth::user(), $request->file('foto_profil'));

        return back()->with('success', 'Foto profil baru berhasil dipasang!');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        if (! $this->profileService->updatePassword(
            Auth::user(),
            $request->validated('current_password'),
            $request->validated('new_password'),
        )) {
            return back()->withErrors(['current_password' => 'Password saat ini salah!']);
        }

        return back()->with('success', 'Kata sandi akun berhasil diubah.');
    }

    public function hapusFoto()
    {
        $this->profileService->deletePhoto(Auth::user());

        return back()->with('success', 'Foto profil telah dihapus.');
    }
}

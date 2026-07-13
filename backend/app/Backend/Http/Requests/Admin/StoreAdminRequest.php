<?php

namespace App\Backend\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Only SuperAdmin can create admins
        return auth()->check() && auth()->user()->isSuperAdmin();
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:40',
            'email' => 'required|email|unique:ms_user,email',
            'password' => 'required|string|min:8',
            'id_role' => 'nullable|in:2,3',
            'no_telp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 40 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'id_role.required' => 'Role wajib dipilih.',
            'id_role.in' => 'Role tidak valid.',
        ];
    }
}

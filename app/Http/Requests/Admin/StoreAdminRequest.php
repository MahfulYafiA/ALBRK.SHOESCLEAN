<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Only SuperAdmin can create/update admins
        return auth()->check() && auth()->user()->isSuperAdmin();
    }

    public function rules(): array
    {
        $userId = $this->route('id') ?? $this->input('id');

        return [
            'nama' => 'required|string|max:40',
            'email' => [
                'required',
                'email',
                Rule::unique('ms_user', 'email')->ignore($userId),
            ],
            'password' => $this->isMethod('put') || $this->input('_method') === 'PUT'
                ? 'nullable|string|min:8'
                : 'required|string|min:8',
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

<?php

namespace App\Backend\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = auth()->id();

        return [
            'nama' => 'required|string|max:40',
            'email' => 'required|email|unique:ms_user,email,' . $userId . ',id_user',
            'no_hp' => 'nullable|string|max:15',
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
            'email.unique' => 'Email sudah digunakan akun lain.',
            'no_hp.max' => 'Nomor WhatsApp maksimal 15 angka.',
            'alamat.max' => 'Alamat maksimal 255 karakter.',
        ];
    }
}

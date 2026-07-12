<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:40',
            'no_telp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string|max:200',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 40 karakter.',
            'no_telp.max' => 'Nomor telepon maksimal 15 karakter.',
            'alamat.max' => 'Alamat maksimal 200 karakter.',
        ];
    }
}

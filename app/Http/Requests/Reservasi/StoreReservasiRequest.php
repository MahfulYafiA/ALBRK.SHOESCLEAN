<?php

namespace App\Http\Requests\Reservasi;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservasiRequest extends FormRequest
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
            'id_layanan' => 'required|exists:ms_layanan,id_layanan',
            'jumlah_sepatu' => 'required|integer|min:1',
            'metode_layanan' => 'required|in:Drop-off,Pick-up',
            'alamat_jemput' => 'nullable|string|max:200',
            'metode_pembayaran' => 'required',
            'no_telp' => 'nullable|string|max:15',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'id_layanan.required' => 'Pilih layanan terlebih dahulu.',
            'id_layanan.exists' => 'Layanan tidak ditemukan.',
            'jumlah_sepatu.required' => 'Jumlah sepatu wajib diisi.',
            'jumlah_sepatu.integer' => 'Jumlah sepatu harus berupa angka.',
            'jumlah_sepatu.min' => 'Jumlah sepatu minimal 1.',
            'metode_layanan.required' => 'Pilih metode layanan.',
            'metode_layanan.in' => 'Metode layanan tidak valid.',
            'metode_pembayaran.required' => 'Pilih metode pembayaran.',
        ];
    }
}

<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreOfflineTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'no_telp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:200',
            'id_layanan' => 'required|exists:ms_layanan,id_layanan',
            'jumlah_sepatu' => 'required|integer|min:1',
            'metode_layanan' => 'required|string|max:20',
            'metode_bayar' => 'required|string|max:50',
            'catatan' => 'nullable|string|max:500',
        ];
    }
}

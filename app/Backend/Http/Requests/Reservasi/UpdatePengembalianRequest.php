<?php

namespace App\Backend\Http\Requests\Reservasi;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePengembalianRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'metode_pengembalian' => 'required|in:diambil,diantar',
            'wa_pengantaran' => 'nullable|string|max:15|required_if:metode_pengembalian,diantar',
            'alamat_pengantaran' => 'nullable|string|max:255|required_if:metode_pengembalian,diantar',
        ];
    }

    public function messages(): array
    {
        return [
            'metode_pengembalian.required' => 'Metode pengembalian wajib dipilih.',
            'metode_pengembalian.in' => 'Metode pengembalian tidak valid.',
            'wa_pengantaran.required_if' => 'Nomor WhatsApp wajib diisi untuk pengantaran.',
            'alamat_pengantaran.required_if' => 'Alamat pengantaran wajib diisi.',
        ];
    }
}

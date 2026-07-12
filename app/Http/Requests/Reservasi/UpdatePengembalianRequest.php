<?php

namespace App\Http\Requests\Reservasi;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePengembalianRequest extends FormRequest
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
            'metode' => 'required|in:Ambil di Toko,Diantar ke Alamat',
            'wa_pengantaran' => 'required_if:metode,Diantar ke Alamat|nullable|string|max:15',
            'alamat_pengantaran' => 'required_if:metode,Diantar ke Alamat|nullable|string|max:200',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'metode.required' => 'Pilih metode pengembalian.',
            'metode.in' => 'Metode pengembalian tidak valid.',
            'wa_pengantaran.required_if' => 'Nomor WhatsApp wajib diisi untuk pengiriman.',
            'alamat_pengantaran.required_if' => 'Alamat pengantaran wajib diisi untuk pengiriman.',
        ];
    }
}

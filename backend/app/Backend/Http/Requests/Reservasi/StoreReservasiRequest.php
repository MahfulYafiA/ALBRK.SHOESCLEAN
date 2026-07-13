<?php

namespace App\Backend\Http\Requests\Reservasi;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservasiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_layanan' => 'required|exists:ms_layanan,id_layanan',
            'jumlah_sepatu' => 'nullable|integer|min:1|max:10',
            'metode_layanan' => 'required|string',
            'alamat_jemput' => 'nullable|string|max:255',
            'metode_pengembalian' => 'required|in:diambil,diantar',
            'wa_pengantaran' => 'nullable|string|max:15|required_if:metode_pengembalian,diantar',
            'alamat_pengantaran' => 'nullable|string|max:255|required_if:metode_pengembalian,diantar',
            'catatan' => 'nullable|string|max:500',
            'metode_pembayaran' => 'required|in:cash,Payment Gateway',
        ];
    }

    public function messages(): array
    {
        return [
            'id_layanan.required' => 'Layanan wajib dipilih.',
            'id_layanan.exists' => 'Layanan tidak ditemukan.',
            'jumlah_sepatu.min' => 'Jumlah sepatu minimal 1.',
            'jumlah_sepatu.max' => 'Jumlah sepatu maksimal 10.',
            'metode_layanan.required' => 'Metode layanan wajib dipilih.',
            'metode_pengembalian.required' => 'Metode pengembalian wajib dipilih.',
            'metode_pengembalian.in' => 'Metode pengembalian tidak valid.',
            'wa_pengantaran.required_if' => 'Nomor WhatsApp wajib diisi untuk pengantaran.',
            'alamat_pengantaran.required_if' => 'Alamat pengantaran wajib diisi.',
            'metode_pembayaran.required' => 'Metode pembayaran wajib dipilih.',
            'metode_pembayaran.in' => 'Metode pembayaran tidak valid.',
        ];
    }
}

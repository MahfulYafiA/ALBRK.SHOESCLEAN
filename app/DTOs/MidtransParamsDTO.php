<?php

namespace App\DTOs;

readonly class MidtransParamsDTO
{
    public function __construct(
        public string $orderId,
        public int $grossAmount,
        public string $customerName,
        public string $customerEmail,
        public ?string $customerPhone,
        public array $itemDetails,
    ) {}

    /**
     * Create DTO from Reservasi model
     */
    public static function fromReservasi($reservasi): self
    {
        $items = [];
        foreach ($reservasi->detail as $detail) {
            $items[] = [
                'id' => $detail->id_layanan,
                'price' => (int) $detail->harga,
                'quantity' => (int) $detail->jumlah,
                'name' => $detail->layanan->nama_layanan ?? 'Layanan',
            ];
        }

        return new self(
            orderId: 'RES-' . $reservasi->id_reservasi . '-' . time(),
            grossAmount: (int) $reservasi->total_harga,
            customerName: $reservasi->user->nama ?? 'Customer',
            customerEmail: $reservasi->user->email ?? 'customer@email.com',
            customerPhone: $reservasi->user->no_telp ?? null,
            itemDetails: $items,
        );
    }

    /**
     * Convert to Midtrans Snap API format
     */
    public function toMidtransParams(): array
    {
        return [
            'transaction_details' => [
                'order_id' => $this->orderId,
                'gross_amount' => $this->grossAmount,
            ],
            'customer_details' => [
                'first_name' => $this->customerName,
                'email' => $this->customerEmail,
                'phone' => $this->customerPhone,
            ],
            'item_details' => $this->itemDetails,
        ];
    }
}

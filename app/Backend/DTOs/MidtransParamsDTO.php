<?php

namespace App\Backend\DTOs;

class MidtransParamsDTO
{
    public function __construct(
        public readonly string $orderId,
        public readonly int $grossAmount,
        public readonly string $customerName,
        public readonly string $customerEmail,
        public readonly ?string $phone = null,
        public readonly ?array $items = null,
    ) {}

    public function toMidtransParams(): array
    {
        $params = [
            'transaction_details' => [
                'order_id' => $this->orderId,
                'gross_amount' => $this->grossAmount,
            ],
            'customer_details' => [
                'first_name' => $this->customerName,
                'email' => $this->customerEmail,
                'phone' => $this->phone,
            ],
            'enabled_payments' => [
                'bca_va',
                'bni_va',
                'bri_va',
                'mandiri_va',
                'gopay',
                'shopeepay',
                'credit_card',
            ],
            'credit_card' => [
                'secure' => true,
            ],
        ];

        if ($this->items) {
            $params['item_details'] = $this->items;
        }

        return $params;
    }
}

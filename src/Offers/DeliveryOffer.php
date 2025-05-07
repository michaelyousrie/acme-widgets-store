<?php

namespace App\Offers;


class DeliveryOffer implements OfferContract
{
    public function name(): string
    {
        return "Delivery";
    }

    public function apply(array $products, float $subtotal): float
    {
        if ($subtotal >= 90) {
            return 0.0;
        }

        return $subtotal < 50 ? 4.95 : 2.95;
    }
}
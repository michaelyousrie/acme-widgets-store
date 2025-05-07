<?php

namespace App\Offers;

use App\Product;

interface OfferContract
{
    public function name(): string;

    /** @param array<Product> $products */
    public function apply(array $products, float $subtotal): float;
}
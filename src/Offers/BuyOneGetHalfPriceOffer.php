<?php

namespace App\Offers;

use App\Product;

class BuyOneGetHalfPriceOffer implements OfferContract
{
    /** @var array<string> $applicableProductCodes */
    private array $applicableProductCodes;

    /** @param array<string> $productCodes */
    public function __construct(array $productCodes)
    {
        $this->applicableProductCodes = $productCodes;
    }

    public function name(): string
    {
        return "Buy One Get Second Half Price";
    }

    public function apply(array $products, float $subtotal): float
    {
        $relevantProducts = array_filter($products, fn($product) => in_array($product->code(), $this->applicableProductCodes));

        // No discount for less than 2 products
        if (count($relevantProducts) < 2) {
            return 0.0;
        }

        // Sort eligible products by price in ascending order
        usort($relevantProducts, fn($a, $b) => $a->price() <=> $b->price());

        $discount = 0.0;

        // Apply the discount on pairs of eligible products
        for ($i = 0; $i < count($relevantProducts); $i += 2) {
            if (isset($relevantProducts[$i + 1])) {
                $discount -= round($relevantProducts[$i + 1]->price() / 2, 2);
            }
        }

        return $discount;
    }
}
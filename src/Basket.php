<?php

namespace App;

use App\Offers\OfferContract;
use InvalidArgumentException;

class Basket
{
    /**
     * @var array<Product> $catalogue
     */
    private array $catalogue;

    /**
     * @var array<OfferContract> $offers
     */
    private array $offers;

    /**
     * @var array<Product> $products
     */
    private array $products = [];


    /**
     * @param array<Product> $catalogue
     * @param array<OfferContract> $offers
     */
    public function __construct(array $catalogue, array $offers = [])
    {
        $this->catalogue = $catalogue;
        $this->offers = $offers;
    }

    public function add(string $productCode): void
    {
        if (!isset($this->catalogue[$productCode])) {
            throw new InvalidArgumentException("Invalid product code: {$productCode}");
        }

        $product = $this->catalogue[$productCode];
        $this->products[] = $product;
    }

    public function empty(): bool
    {
        return count($this->products) <= 0;
    }

    public function total(bool $withInfo = false): float
    {
        $subtotal = array_reduce(
            $this->products,
            fn($carry, $product) => $carry + $product->price(),
            0.0
        );

        foreach ($this->offers as $offer) {
            if ($offer instanceof OfferContract) {
                $value = round($offer->apply($this->products, $subtotal), 2);
                $subtotal += $value;

                if ($withInfo and $value != 0) {
                    $color = $value < 0 ? 'green' : 'red'; // green for discount, red for extra.

                    CLI::printWithColor("{$offer->name()}: \${$value}", $color);
                }
            }
        }

        return round($subtotal, 2);
    }

    /** @return array<Product> */
    public function products(): array
    {
        return $this->products;
    }
}
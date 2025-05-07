<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Product;
use App\Basket;

class BasketTest extends TestCase
{
    private array $config;

    protected function setUp(): void
    {
        parent::setUp();

        $this->config = require __DIR__ . '/../config.php';
    }

    /**
     * @return array[]
     */
    public function basketTotalProvider(): array
    {
        return [
            'B01 and G01' => [['B01', 'G01'], 37.85],
            'Two R01' => [['R01', 'R01'], 54.37],
            'R01 and G01' => [['R01', 'G01'], 60.85],
            'Two B01 and three R01' => [['B01', 'B01', 'R01', 'R01', 'R01'], 98.27]
        ];
    }

    /**
     * @dataProvider basketTotalProvider
     * @param array $products
     * @param float $expectedTotal
     */
    public function testBasketTotal(array $products, float $expectedTotal): void
    {
        $basket = new Basket($this->config['products'], $this->config['offers']);

        foreach ($products as $productCode) {
            $basket->add($productCode);
        }

        $this->assertEquals($expectedTotal, $basket->total());
    }
}
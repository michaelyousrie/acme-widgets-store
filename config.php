<?php

use App\Offers\BuyOneGetHalfPriceOffer;
use App\Offers\DeliveryOffer;
use App\Product;

return [
    'products' => [
        'R01' => new Product('R01', 'Red Widget', 32.95),
        'G01' => new Product('G01',  'Green Widget', 24.95),
        'B01' => new Product('B01', 'Blue Widget', 7.95),
    ],
    'offers' => [
        new BuyOneGetHalfPriceOffer(['R01']),
        new DeliveryOffer()
    ]
];
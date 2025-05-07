<?php

use App\Basket;

require 'vendor/autoload.php';

$config = include 'config.php';
$basket = new Basket($config['products'], $config['offers']);

$basket->add('B01');
$basket->add('B01');
$basket->add('R01');
$basket->add('R01');
$basket->add('R01');

echo 'Total: $' . $basket->total();
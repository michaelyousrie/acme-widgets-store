<?php

use App\Basket;
use App\CLI;
use App\Product;

require 'vendor/autoload.php';

function printCatalogue(array $catalogue): void
{
    CLI::printTable(
        ['Code', 'Name', 'Price'],
        $catalogue,
        headerColor: 'yellow',
        dataColor: 'cyan'
    );
}

function printBasket(array $products): void
{
    CLI::printWithColor("Your Basket", 'blue');
    $basketProductsArray = array_map(fn(Product $product) => [$product->code(), $product->name(), $product->price()], $products);
    CLI::printTable(['Code', 'Name', 'Price'], $basketProductsArray);
}

$config = require_once 'config.php';
$basket = new Basket($config['products'], $config['offers']);

CLI::showWelcome();

while (true) {
    CLI::clearScreen();
    CLI::printWithColor("Our Catalogue", 'blue');
    $productsArray = array_map(fn(Product $product) => [$product->code(), $product->name(), $product->price()], $config['products']);

    printCatalogue($productsArray);

    // Print Shopping Basket
    if (!$basket->empty()) {
        printBasket($basket->products());
        CLI::printWithColor("Total: {$basket->total()}", 'green');
    }

    $product = strtoupper(CLI::ask('Enter product code (q to checkout): ', 'yellow'));
    if (in_array(strtolower($product), ['q', 'quit', 'exit', 'checkout', 'bye'])) {
        break;
    }

    $productCodes = array_keys($config['products']);
    if (!in_array($product, $productCodes)) {
        $productCodes = implode(', ', $productCodes);
        CLI::printWithColor("Invalid product code: {$product}. Possible values: ({$productCodes})", 'red');
        CLI::printWithColor("You must be punished. -5 points from gryffindor and 4 seconds timeout.", 'red');
        sleep(4);
        continue;
    }

    CLI::printWithColor("Added: {$config['products'][$product]->name()}", 'green');
    CLI::divider();
    $basket->add($product);
}

CLI::clearScreen();
CLI::divider('-');

$checkoutText = $basket->empty() ? "Your cart is empty." : "Total: \${$basket->total(true)}";

CLI::printWithColor($checkoutText, 'yellow');
CLI::divider('-');
CLI::printWithColor("Thank you for shopping with Acme 🙏", 'cyan');
CLI::printWithColor("Have a nice day 👋", 'cyan');
CLI::divider('-');

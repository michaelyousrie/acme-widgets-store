# Acme Widget Co. Sales System

A proof of concept implementation of Acme Widget Co.'s sales system, featuring a product catalog, shopping basket, and special offers engine. Built with PHP 8.0+.

## Project Overview

This system demonstrates a flexible e-commerce solution with:
- Product catalog management
- Shopping basket functionality
- Dynamic offer application system
- Configurable delivery cost calculations

## Features

### Product Management
- Products defined by code, name, and price
- Clean OOP implementation using PHP 8.0+ features
- PSR-4 compliant autoloading

### Shopping Basket
- Add products by product code
- Automatic offer calculations
- Real-time total calculation with applied discounts

### Special Offers
#### Buy One Get Half Price
- Configurable for specific product codes
- Automatically pairs eligible products
- Applies 50% discount on the second item

#### Dynamic Delivery Costs
- Orders under \$50: \$4.95 delivery
- Orders between \$50-\$90: \$2.95 delivery
- Orders over \$90: Free delivery

#### Users can't delete products so we can boost sales (probably illegal? still funny)

## Requirements
- PHP 8.0 or higher
- Composer

## Installation

```bash
# Clone the repository
git clone https://github.com/michaelyousrie/acme-widgets-store

# Change Directory
cd acme-widgets-store

# Install dependencies
composer install

# Run the CLI
php index.php
```

## Docker (optional)
```bash
  # build the image
  docker build -t acme-widgets-store .
  
  # Run the image interactively
  docker run -it acme-widgets-store
```

## Usage

Included is a CLI app that allows adding products to the cart and calculate the total value.
(Don't make mistakes using the CLI or it'll get mad.)
```bash
  php index.php
```

The system also uses a simple object-oriented approach:

```php
// Create products
$catalog = [
    new Product('R01', 'Red Widget', 32.95)
];

// Initialize basket with catalog and offers
$basket = new Basket($catalog, [
    new BuyOneGetHalfPriceOffer(['R01']),
    new DeliveryOffer()
]);

// Add products
$basket->add('R01');

// Calculate total with applied offers
$total = $basket->total();
```

## Development

### Running Tests
```bash
  composer test
```

### Static Analysis
```bash
  composer analyze
```

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

## Requirements
- PHP 8.0 or higher
- Composer

## Installation

```bash
# Clone the repository
git clone [repository-url]
cd thrivecart-acme-widget

# Install dependencies
composer install
```

## Usage

The system uses a simple object-oriented approach:

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

### Code Style Fixing
```bash
composer fix-code
```

## Contributing

1. Ensure all tests pass
2. Run static analysis: `composer analyze`
3. Fix code style: `composer fix-code`
4. Create a pull request with a clear description

## License

[License Type] - See LICENSE file for details

## Support

For issues and feature requests, please use the GitHub issues tracker.


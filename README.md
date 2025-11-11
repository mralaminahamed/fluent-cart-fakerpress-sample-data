# Fluent Cart FakerPress Sample Data

This directory contains sample data files used by the Fluent Cart FakerPress plugin to generate realistic test data for e-commerce stores.

## Directory Structure

```
fluent-cart-fakerpress-sample-data/
├── customers/
│   └── en_US/
│       ├── countries.json          # Country data with codes, names, currencies
│       ├── preferred_languages.json # Customer language preferences
│       ├── currencies.json         # Currency data with symbols and weights
│       ├── preferred_categories.json # Product category preferences
│       ├── customer_tags.json      # Customer segmentation tags
│       ├── phone_patterns.json     # Phone number formats by country
│       ├── states_provinces.json   # State/province data by country
│       └── postcode_patterns.json  # Postal code formats by country
├── products/
│   └── en_US/
│       └── product_names.json      # Product adjectives and names for generation
├── coupons/
│   └── en_US/
│       └── coupon_data.json        # Coupon types, code patterns, usage limits
├── orders/
│   └── en_US/
│       └── order_data.json         # Payment methods, statuses, currencies, tax rates
├── shipping-plans/
│   └── en_US/
│       └── shipping_data.json      # Shipping types, timeframes, coverage areas
├── tax-classes/
│   └── en_US/
│       └── tax_data.json           # Tax rates and categories
└── transactions/
    └── en_US/
        └── transaction_data.json   # Payment statuses, transaction types, gateways
```

## File Formats

All files are JSON format with the following conventions:

### Countries (countries.json)
```json
[
  {
    "code": "US",
    "name": "United States",
    "currency": "USD",
    "phone_code": "+1",
    "states_count": 50
  }
]
```

### Languages (preferred_languages.json)
```json
[
  {
    "code": "en",
    "name": "English",
    "weight": 0.4
  }
]
```

### Currencies (currencies.json)
```json
[
  {
    "code": "USD",
    "name": "US Dollar",
    "symbol": "$",
    "weight": 0.35
  }
]
```

### Categories (preferred_categories.json)
```json
[
  {
    "name": "Electronics",
    "weight": 0.25,
    "subcategories": ["Smartphones", "Laptops", "Headphones"]
  }
]
```

### Customer Tags (customer_tags.json)
```json
[
  {
    "name": "VIP Customer",
    "weight": 0.05,
    "color": "#FFD700"
  }
]
```

### Phone Patterns (phone_patterns.json)
```json
[
  {
    "country": "US",
    "pattern": "(###) ###-####",
    "weight": 0.4
  }
]
```

### States/Provinces (states_provinces.json)
```json
[
  {
    "country": "US",
    "states": ["Alabama", "Alaska", "Arizona", ...]
  }
]
```

### Postcode Patterns (postcode_patterns.json)
```json
[
  {
    "country": "US",
    "pattern": "#####",
    "format": "#####",
    "weight": 0.4
  }
]
```

### Product Names (product_names.json)
```json
{
  "adjectives": ["Premium", "Deluxe", "Professional", ...],
  "products": ["Wireless Headphones", "Smart Watch", ...]
}
```

### Coupon Data (coupon_data.json)
```json
{
  "coupon_types": [
    {
      "type": "percentage",
      "name": "Percentage Discount",
      "weight": 0.6,
      "min_discount": 5,
      "max_discount": 50
    }
  ],
  "code_patterns": ["SAVE###", "DISCOUNT###", ...],
  "usage_limits": [{"min": 10, "max": 100, "weight": 0.4}],
  "descriptions": ["Limited time offer...", ...]
}
```

### Order Data (order_data.json)
```json
{
  "payment_methods": [
    {
      "method": "stripe",
      "name": "Credit Card (Stripe)",
      "weight": 0.5
    }
  ],
  "order_statuses": [
    {
      "status": "completed",
      "name": "Completed",
      "weight": 0.6
    }
  ],
  "currencies": [
    {
      "code": "USD",
      "name": "US Dollar",
      "symbol": "$",
      "weight": 0.7
    }
  ],
  "tax_rates": [
    {
      "rate": 0.08,
      "name": "Standard Tax (8%)",
      "weight": 0.6
    }
  ]
}
```

### Shipping Data (shipping_data.json)
```json
{
  "shipping_types": [
    {
      "type": "flat_rate",
      "name": "Flat Rate",
      "weight": 0.5,
      "cost_ranges": {"min": 5.99, "max": 29.99}
    }
  ],
  "delivery_timeframes": [
    {
      "name": "2-3 Days",
      "min_days": 2,
      "max_days": 3,
      "weight": 0.4
    }
  ],
  "coverage_areas": [
    {
      "area": "domestic",
      "name": "Domestic Shipping",
      "weight": 0.7
    }
  ]
}
```

### Tax Data (tax_data.json)
```json
{
  "tax_rates": [
    {
      "rate": 0.08,
      "name": "Standard Rate (8%)",
      "description": "Standard tax rate for most goods",
      "weight": 0.6
    }
  ],
  "tax_categories": [
    {
      "name": "Standard Goods",
      "description": "Regular taxable goods and services",
      "weight": 0.7
    }
  ]
}
```

### Transaction Data (transaction_data.json)
```json
{
  "payment_statuses": [
    {
      "status": "completed",
      "name": "Completed",
      "weight": 0.85
    }
  ],
  "transaction_types": [
    {
      "type": "charge",
      "name": "Payment Charge",
      "weight": 0.9
    }
  ],
  "payment_gateways": [
    {
      "gateway": "stripe",
      "name": "Stripe",
      "weight": 0.5
    }
  ]
}
```

## Usage

The plugin automatically loads these files based on the current locale setting. Files are loaded from:

`wp-content/uploads/fluent-cart-fakerpress-sample-data/{resource_type}/{locale}/{filename}.json`

Currently, the Customer and Product generators actively use sample data. Other generators (Coupons, Orders, Shipping Plans, Tax Classes, Transactions) have sample data prepared for future implementation of externalized configuration.

## Adding New Locales

To add support for a new locale:

1. Create a new directory under each resource type: `customers/fr_FR/`, `products/fr_FR/`
2. Add translated/localized versions of the JSON files
3. The plugin will automatically use the appropriate locale files

## Contributing

When adding new sample data:

- Ensure JSON is valid and properly formatted
- Include realistic, diverse data
- Use appropriate weights for random selection
- Follow the established naming conventions
- Test with the plugin to ensure compatibility
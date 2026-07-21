# StoreSeeder Sample Data

Locale-specific reference data used by the [StoreSeeder](https://github.com/mralaminahamed/storeseeder) plugin to make generated test data more realistic (product names, addresses, customer tags, and so on).

The plugin downloads this repository on demand — only when an administrator triggers a sync, or when a generator needs data it has not fetched yet — and reads the JSON files locally. No site, user, or store data is ever sent here.

## Structure

Data is grouped per integration, so a single repository can serve StoreSeeder across different e-commerce platforms:

```
integrations/
└── fluent-cart/                 # Fluent Cart integration
    ├── customers/
    │   └── en_US/
    │       ├── countries.json
    │       ├── preferred_languages.json
    │       ├── currencies.json
    │       ├── preferred_categories.json
    │       ├── customer_tags.json
    │       ├── phone_patterns.json
    │       ├── states_provinces.json
    │       └── postcode_patterns.json
    ├── products/
    │   └── en_US/
    ├── orders/
    ├── coupons/
    ├── shipping-plans/
    ├── tax-classes/
    └── transactions/
```

Each integration follows the same shape: `integrations/<integration>/<resource>/<locale>/<file>.json`. Additional integrations can be added under `integrations/` without affecting existing ones.

## License

GPL-2.0-or-later — see [LICENSE](LICENSE).

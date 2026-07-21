# StoreSeeder Sample Data — Fluent Cart

Locale-specific reference data used by the [StoreSeeder](https://github.com/mralaminahamed/storeseeder) plugin to make generated **Fluent Cart** test data more realistic (product names, addresses, customer tags, and so on).

This is a **per-integration** repository: it holds only the Fluent Cart data, so it stays small and downloads quickly. Each StoreSeeder integration has its own `storeseeder-sample-data-<integration>` repository.

The plugin downloads this repository on demand — only when an administrator triggers a sync, or when a generator needs data it has not fetched yet — and reads the JSON files locally. No site, user, or store data is ever sent here.

## Structure

Data sits flat at the root, one directory per resource, then per locale:

```
<resource>/<locale>/<file>.json

customers/
└── en_US/
    ├── countries.json
    ├── preferred_languages.json
    ├── currencies.json
    ├── preferred_categories.json
    ├── customer_tags.json
    ├── phone_patterns.json
    ├── states_provinces.json
    └── postcode_patterns.json
products/
orders/
coupons/
shipping-plans/
tax-classes/
transactions/
```

## License

GPL-2.0-or-later — see [LICENSE](LICENSE).

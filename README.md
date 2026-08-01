# StoreSeeder sample data

Reference vocabulary used by [StoreSeeder](https://github.com/mralaminahamed/storeseeder) to make
generated data look like it came from a real store.

This is the **default** vocabulary — the words every run uses when no recipe is chosen. It is not
platform-specific despite the repository name: the plugin has been multi-platform since 1.1.0, and
these are country lists, phone patterns and product nouns, none of which belong to Fluent Cart or
to anything else. The name is kept for the URL that shipped versions point at.

For vocabulary that makes a whole *shop* — a grocer, a boutique — see
[storeseeder-recipes](https://github.com/mralaminahamed/storeseeder-recipes). A recipe overrides
whatever it ships and inherits the rest from here.

Downloaded only after an administrator accepts the consent prompt on StoreSeeder's Settings
screen, then read locally. No site, user or store data is ever sent here. See
[`docs/external-services.md`](https://github.com/mralaminahamed/storeseeder/blob/trunk/docs/external-services.md).

## Layout

```
manifest.json                        the index — generated, never hand-edited
<resource>/
  manifest.json                      what this resource ships, and who reads it
  <locale>/<file>.json
```

Regenerate both after any change:

```bash
php build-manifests.php
```

## What is here

| Resource | Files | Read by | Locales |
|---|---|---|---|
| `products` | `product_names.json` | `Product` | `en_US` |
| `customers` | 8 — countries, currencies, phone and postcode patterns, states, tags, languages, categories | `Customer` | `en_US` |
| `brands` | `stems.json`, `suffixes.json` | `Brand` | `en_US` |
| `product_categories` | `departments.json`, `subsections.json` | `Product_Category` | `en_US` |
| `product_tags` | `labels.json` | `Product_Tag` | `en_US` |
| `orders` | `order_data.json` | — nothing | `en_US` |
| `coupons` | `coupon_data.json` | — nothing | `en_US` |
| `shipping-plans` | `shipping_data.json` | — nothing | `en_US` |
| `tax-classes` | `tax_data.json` | — nothing | `en_US` |
| `transactions` | `transaction_data.json` | — nothing | `en_US` |

**Five of those files are read by nothing.** They are recorded as such in the manifests rather than
quietly left to look load-bearing — it is the same defect as a parameter the admin offers and no
generator reads, and the same fix: say so. Either a generator starts reading one, or it goes. Until
then nobody should assume editing `order_data.json` changes an order.

The `brands`, `product_categories` and `product_tags` directories mirror constants that still live
in the plugin. Those constants are the offline fallback — a site that has never accepted the consent
prompt still generates sensible categories — so the two must be kept in step, and this repository is
where a change should start.

## Adding a locale

Add `<resource>/<locale>/<file>.json` and regenerate the manifests. Nothing else.

StoreSeeder falls back to `en_US` for any file a locale does not carry, so a partial translation is
useful immediately: translate `product_names.json` and product titles are localised while phone
patterns keep working. FakerPHP still supplies names, addresses and phone numbers in the requested
locale either way — this vocabulary is the part it cannot know.

A locale is only worth adding if FakerPHP ships a provider for it. StoreSeeder's `Platforms\Locale`
is the list of those, and its test fails if the two disagree.

## File shapes

Most files are a single named list:

```json
{ "labels": ["Bestseller", "Eco-friendly", "Handmade"] }
```

`products/product_names.json` is two, crossed at generation time:

```json
{ "adjectives": ["Premium", "Wireless"], "products": ["Headphones", "Kettle"] }
```

A bare array works too. The plugin takes the key matching the filename when the file is an object,
and the whole array when it is not — so one file can carry several related lists.

Anything empty, or missing, falls back. There is no failure mode where a bad file produces a blank
product name; the worst case is generic words.

## Licence

GPL-2.0-or-later — see [LICENSE](LICENSE).

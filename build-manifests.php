<?php
/**
 * Regenerate manifest.json at the root and in each resource directory.
 *
 * Generated rather than hand-kept: a manifest maintained by hand is one that eventually disagrees
 * with the files it describes, and the whole reason StoreSeeder reads a manifest instead of
 * globbing is to be able to tell "not downloaded" apart from "not written".
 *
 * `read_by` is deliberately part of the output. Five files in this repository are read by nothing,
 * and recording that is more useful than deleting them or pretending otherwise — it is the same
 * defect as a declared parameter that changes no output, and the same fix: say so.
 *
 * Usage: php build-manifests.php
 */

$root = __DIR__;

// Which generator consumes each file. Kept here rather than inferred, because the only way to
// infer it is to read the plugin's source, and this repository is downloaded without it.
$readers = array(
	'products/product_names'             => 'Product',
	'customers/countries'                => 'Customer',
	'customers/preferred_languages'      => 'Customer',
	'customers/currencies'               => 'Customer',
	'customers/preferred_categories'     => 'Customer',
	'customers/customer_tags'            => 'Customer',
	'customers/phone_patterns'           => 'Customer',
	'customers/states_provinces'         => 'Customer',
	'customers/postcode_patterns'        => 'Customer',
	'brands/stems'                       => 'Brand',
	'brands/suffixes'                    => 'Brand',
	'product_categories/departments'     => 'Product_Category',
	'product_categories/subsections'     => 'Product_Category',
	'product_tags/labels'                => 'Product_Tag',
);

$resources = array();

foreach ( glob( $root . '/*', GLOB_ONLYDIR ) as $dir ) {
	$resource = basename( $dir );

	if ( in_array( $resource, array( '.git', '.idea' ), true ) ) {
		continue;
	}

	$locales = array();
	$files   = array();

	foreach ( glob( $dir . '/*', GLOB_ONLYDIR ) as $locale_dir ) {
		$locale    = basename( $locale_dir );
		$locales[] = $locale;

		foreach ( glob( $locale_dir . '/*.json' ) as $file ) {
			$name = basename( $file, '.json' );

			if ( ! isset( $files[ $name ] ) ) {
				$files[ $name ] = array(
					'file'    => $name . '.json',
					'read_by' => $readers[ $resource . '/' . $name ] ?? null,
					'locales' => array(),
				);
			}

			$files[ $name ]['locales'][] = $locale;
		}
	}

	if ( array() === $locales ) {
		continue;
	}

	sort( $locales );
	ksort( $files );

	$entry = array(
		'resource' => $resource,
		'locales'  => $locales,
		'files'    => array_values( $files ),
	);

	file_put_contents(
		$dir . '/manifest.json',
		json_encode( $entry, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "\n"
	);

	$unread = 0;

	foreach ( $entry['files'] as $file ) {
		if ( null === $file['read_by'] ) {
			++$unread;
		}
	}

	$resources[] = array(
		'resource' => $resource,
		'locales'  => $locales,
		'files'    => count( $entry['files'] ),
		'unread'   => $unread,
	);
}

usort(
	$resources,
	static function ( array $a, array $b ): int {
		return strcmp( $a['resource'], $b['resource'] );
	}
);

$all = array();

foreach ( $resources as $resource ) {
	$all = array_merge( $all, $resource['locales'] );
}

$all = array_values( array_unique( $all ) );
sort( $all );

file_put_contents(
	$root . '/manifest.json',
	json_encode(
		array(
			'version'   => 1,
			'locales'   => $all,
			'resources' => $resources,
		),
		JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
	) . "\n"
);

printf( "manifest.json — %d resources, locales: %s\n", count( $resources ), implode( ', ', $all ) );

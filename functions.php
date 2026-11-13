<?php
/**
 * OneBerlin – Theme-Funktionen.
 *
 * @package OneBerlin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ONEBERLIN_VERSION', '1.0.0' );

/**
 * Theme-Unterstützungen.
 */
function oneberlin_setup() {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo' );

	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	add_editor_style( 'assets/css/oneberlin.css' );

	load_theme_textdomain( 'oneberlin', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'oneberlin_setup' );

/**
 * Stile und Skripte im Frontend.
 */
function oneberlin_assets() {
	$uri = get_template_directory_uri();
	$dir = get_template_directory();

	wp_enqueue_style(
		'oneberlin',
		$uri . '/assets/css/oneberlin.css',
		array(),
		ONEBERLIN_VERSION . '.' . filemtime( $dir . '/assets/css/oneberlin.css' )
	);

	wp_enqueue_script(
		'oneberlin',
		$uri . '/assets/js/oneberlin.js',
		array(),
		ONEBERLIN_VERSION . '.' . filemtime( $dir . '/assets/js/oneberlin.js' ),
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);
}
add_action( 'wp_enqueue_scripts', 'oneberlin_assets' );

/**
 * Bereichs-Klassen am <body>, damit Musik-, Software- und Magazinseiten
 * ihre übernommene Gestaltung behalten (ersetzt die alten page-id-Listen).
 *
 * @param string[] $classes Body-Klassen.
 * @return string[]
 */
function oneberlin_area_body_class( $classes ) {
	$areas = array(
		'ob-area-musik'    => array( 220670, 220888, 220889, 220890, 220891, 220892, 220893, 220894, 220895, 220896, 220897, 220898, 220886, 220671, 220872, 220873, 220874, 220875, 220876, 220877, 220879, 220870, 220871 ),
		'ob-area-software' => array( 220673, 220907, 220908, 220910 ),
		'ob-area-magazin'  => array( 220674, 220924, 220925, 220926, 220927, 220928, 220929, 220930, 220931, 220932, 220933, 220934, 220935, 220936, 220937, 220938, 220939, 220940, 220941, 220942, 220943, 220944, 220945, 220946, 220921, 220922 ),
	);

	/**
	 * Filter: Seiten- und Beitrags-IDs je Bereich anpassen.
	 *
	 * @param array $areas Klasse => IDs.
	 */
	$areas = apply_filters( 'oneberlin_area_ids', $areas );

	if ( is_singular() ) {
		$id = (int) get_queried_object_id();
		foreach ( $areas as $class => $ids ) {
			if ( in_array( $id, array_map( 'intval', $ids ), true ) ) {
				$classes[] = $class;
			}
		}
	}

	return $classes;
}
add_filter( 'body_class', 'oneberlin_area_body_class' );

/**
 * Musterkategorie „OneBerlin“ für eigene Block-Vorlagen.
 */
function oneberlin_pattern_category() {
	register_block_pattern_category(
		'oneberlin',
		array( 'label' => __( 'OneBerlin', 'oneberlin' ) )
	);
}
add_action( 'init', 'oneberlin_pattern_category' );

/**
 * WooCommerce: 4 Produkte pro Reihe in klassischen Listen (Shortcodes).
 */
add_filter(
	'loop_shop_columns',
	static function () {
		return 4;
	}
);

/**
 * Theme-Farbe für mobile Browser.
 */
function oneberlin_meta_theme_color() {
	echo '<meta name="theme-color" content="#0B1F44">' . "\n";
}
add_action( 'wp_head', 'oneberlin_meta_theme_color', 2 );

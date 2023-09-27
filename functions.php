<?php
/**
 * This file adds functions to the Lokal Base WordPress theme.
 *
 * @package Lokal Base
 * @author  WP Engine
 * @license GNU General Public License v2 or later
 * @link    https://lokalwp.com/
 */

if ( ! function_exists( 'lokal_setup' ) ) {

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since 0.8.0
	 *
	 * @return void
	 */
	function lokal_setup() {

		// Make theme available for translation.
		load_theme_textdomain( 'lokal', get_template_directory() . '/languages' );

		// Enqueue editor styles and fonts.
		add_editor_style(
			array(
				'./style.css',
			)
		);

		// Remove core block patterns.
		remove_theme_support( 'core-block-patterns' );

	}
}
add_action( 'after_setup_theme', 'lokal_setup' );

// Enqueue style sheet.
add_action( 'wp_enqueue_scripts', 'lokal_enqueue_style_sheet' );
function lokal_enqueue_style_sheet() {

	wp_enqueue_style( 'lokal', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
}

/**
 * Register block styles.
 *
 * @since 0.9.2
 */
function lokal_register_block_styles() {

	$block_styles = array(
		'core/columns' => array(
			'columns-reverse' => __( 'Reverse', 'lokal' ),
		),
		'core/group' => array(
			'shadow-light' => __( 'Shadow', 'lokal' ),
			'shadow-solid' => __( 'Solid', 'lokal' ),
		),
		'core/image' => array(
			'shadow-light' => __( 'Shadow', 'lokal' ),
			'shadow-solid' => __( 'Solid', 'lokal' ),
		),
		'core/list' => array(
			'no-disc' => __( 'No Disc', 'lokal' ),
		),
		'core/navigation-link' => array(
			'outline' => __( 'Outline', 'lokal' ),
		),
		'core/quote' => array(
			'shadow-light' => __( 'Shadow', 'lokal' ),
			'shadow-solid' => __( 'Solid', 'lokal' ),
		),
		'core/social-links' => array(
			'outline' => __( 'Outline', 'lokal' ),
		),
	);

	foreach ( $block_styles as $block => $styles ) {
		foreach ( $styles as $style_name => $style_label ) {
			register_block_style(
				$block,
				array(
					'name'  => $style_name,
					'label' => $style_label,
				)
			);
		}
	}
}
add_action( 'init', 'lokal_register_block_styles' );

/**
 * Register block pattern categories.
 *
 * @since 1.0.4
 */
function lokal_register_block_pattern_categories() {

	register_block_pattern_category(
		'page',
		array(
			'label'       => __( 'Page', 'lokal' ),
			'description' => __( 'Create a full page with multiple patterns that are grouped together.', 'lokal' ),
		)
	);
	register_block_pattern_category(
		'pricing',
		array(
			'label'       => __( 'Pricing', 'lokal' ),
			'description' => __( 'Compare features for your digital products or service plans.', 'lokal' ),
		)
	);

}

add_action( 'init', 'lokal_register_block_pattern_categories' );

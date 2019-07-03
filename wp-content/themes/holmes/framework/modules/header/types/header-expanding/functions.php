<?php

if ( ! function_exists( 'holmes_mkdf_register_header_expanding_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function holmes_mkdf_register_header_expanding_type( $header_types ) {
		$header_type = array(
			'header-expanding' => 'Holmes\Modules\Header\Types\HeaderExpanding'
		);

		$header_types = array_merge( $header_types, $header_type );

		return $header_types;
	}
}

if ( ! function_exists( 'holmes_mkdf_init_register_header_expanding_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function holmes_mkdf_init_register_header_expanding_type() {
		add_filter( 'holmes_mkdf_register_header_type_class', 'holmes_mkdf_register_header_expanding_type' );
	}

	add_action( 'holmes_mkdf_before_header_function_init', 'holmes_mkdf_init_register_header_expanding_type' );
}

if ( ! function_exists( 'holmes_mkdf_get_expanded_menu_icon_class' ) ) {
	/**
	 * Loads full screen menu icon class
	 */
	function holmes_mkdf_get_expanded_menu_icon_class() {
		$classes = array(
			'mkdf-expanding-menu-opener'
		);

		$classes[] = holmes_mkdf_get_icon_sources_class( 'fullscreen_menu', 'mkdf-expanded-menu-opener' );

		return $classes;
	}
}
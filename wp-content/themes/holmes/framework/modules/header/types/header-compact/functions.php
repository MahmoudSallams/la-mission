<?php

if ( ! function_exists( 'holmes_mkdf_register_header_compact_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function holmes_mkdf_register_header_compact_type( $header_types ) {
		$header_type = array(
			'header-compact' => 'Holmes\Modules\Header\Types\HeaderCompact'
		);

		$header_types = array_merge( $header_types, $header_type );

		return $header_types;
	}
}

if ( ! function_exists( 'holmes_mkdf_init_register_header_compact_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function holmes_mkdf_init_register_header_compact_type() {
		add_filter( 'holmes_mkdf_register_header_type_class', 'holmes_mkdf_register_header_compact_type' );
	}

	add_action( 'holmes_mkdf_before_header_function_init', 'holmes_mkdf_init_register_header_compact_type' );
}

//if ( ! function_exists( 'holmes_mkdf_include_header_compact_full_screen_menu' ) ) {
//	/**
//	 * Registers additional menu navigation for theme
//	 */
//	function holmes_mkdf_include_header_compact_full_screen_menu( $menus ) {
//		$menus['popup-navigation'] = esc_html__( 'Full Screen Navigation', 'holmes' );
//
//		return $menus;
//	}
//
//	if ( holmes_mkdf_check_is_header_type_enabled( 'header-compact' ) ) {
//		add_filter( 'holmes_mkdf_register_headers_menu', 'holmes_mkdf_include_header_compact_full_screen_menu' );
//	}
//}

//if ( ! function_exists( 'holmes_mkdf_get_fullscreen_menu_icon_class' ) ) {
//	/**
//	 * Loads full screen menu icon class
//	 */
//	function holmes_mkdf_get_fullscreen_menu_icon_class() {
//		$classes = array(
//			'mkdf-fullscreen-menu-opener'
//		);
//
//		$classes[] = holmes_mkdf_get_icon_sources_class( 'fullscreen_menu', 'mkdf-fullscreen-menu-opener' );
//
//		return $classes;
//	}
//}
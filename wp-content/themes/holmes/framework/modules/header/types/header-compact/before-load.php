<?php

if ( ! function_exists( 'holmes_mkdf_set_header_compact_type_global_option' ) ) {
	/**
	 * This function set header type value for global header option map
	 */
	function holmes_mkdf_set_header_compact_type_global_option( $header_types ) {
		$header_types['header-compact'] = array(
			'image' => MIKADO_FRAMEWORK_HEADER_TYPES_ROOT . '/header-compact/assets/img/header-compact.png',
			'label' => esc_html__( 'Compact', 'holmes' )
		);

		return $header_types;
	}

	add_filter( 'holmes_mkdf_header_type_global_option', 'holmes_mkdf_set_header_compact_type_global_option' );
}

if ( ! function_exists( 'holmes_mkdf_set_header_compact_type_meta_boxes_option' ) ) {
	/**
	 * This function set header type value for header meta boxes map
	 */
	function holmes_mkdf_set_header_compact_type_meta_boxes_option( $header_type_options ) {
		$header_type_options['header-compact'] = esc_html__( 'Compact', 'holmes' );

		return $header_type_options;
	}

	add_filter( 'holmes_mkdf_header_type_meta_boxes', 'holmes_mkdf_set_header_compact_type_meta_boxes_option' );
}

if ( ! function_exists( 'holmes_mkdf_set_hide_dep_options_header_compact' ) ) {
	/**
	 * This function is used to hide all containers/panels for admin options when this header type is selected
	 */
	function holmes_mkdf_set_hide_dep_options_header_compact( $hide_dep_options ) {
		$hide_dep_options[] = 'header-compact';

		return $hide_dep_options;
	}

	// header global panel options
	//add_filter( 'holmes_mkdf_header_logo_area_hide_global_option', 'holmes_mkdf_set_hide_dep_options_header_compact' );
	add_filter( 'holmes_mkdf_header_main_menu_hide_global_option', 'holmes_mkdf_set_hide_dep_options_header_compact' );
	add_filter( 'holmes_mkdf_menu_toggle_hide_global_option', 'holmes_mkdf_set_hide_dep_options_header_compact' );
	add_filter( 'holmes_mkdf_full_screen_menu_hide_global_option', 'holmes_mkdf_set_hide_dep_options_header_compact' );

	// header global panel meta boxes
	//add_filter( 'holmes_mkdf_header_logo_area_hide_meta_boxes', 'holmes_mkdf_set_hide_dep_options_header_compact' );

	// header types panel options
	//add_filter( 'holmes_mkdf_header_centered_hide_global_option', 'holmes_mkdf_set_hide_dep_options_header_compact' );
	//add_filter( 'holmes_mkdf_header_standard_hide_global_option', 'holmes_mkdf_set_hide_dep_options_header_compact' );
	//add_filter( 'holmes_mkdf_header_vertical_hide_global_option', 'holmes_mkdf_set_hide_dep_options_header_compact' );
	//add_filter( 'holmes_mkdf_header_vertical_menu_hide_global_option', 'holmes_mkdf_set_hide_dep_options_header_compact' );
	//add_filter( 'holmes_mkdf_header_vertical_closed_hide_global_option', 'holmes_mkdf_set_hide_dep_options_header_compact' );
	//add_filter( 'holmes_mkdf_header_vertical_sliding_hide_global_option', 'holmes_mkdf_set_hide_dep_options_header_compact' );

	// header types panel meta boxes
	//add_filter( 'holmes_mkdf_header_centered_hide_meta_boxes', 'holmes_mkdf_set_hide_dep_options_header_compact' );
	//add_filter( 'holmes_mkdf_header_standard_hide_meta_boxes', 'holmes_mkdf_set_hide_dep_options_header_compact' );
	//add_filter( 'holmes_mkdf_header_vertical_hide_meta_boxes', 'holmes_mkdf_set_hide_dep_options_header_compact' );

	// header dropdown styles meta boxes
	add_filter( 'holmes_mkdf_dropdown_hide_meta_boxes', 'holmes_mkdf_set_hide_dep_options_header_compact' );
}
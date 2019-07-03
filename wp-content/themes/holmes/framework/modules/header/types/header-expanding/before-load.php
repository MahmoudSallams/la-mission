<?php

if ( ! function_exists( 'holmes_mkdf_set_header_expanding_type_global_option' ) ) {
	/**
	 * This function set header type value for global header option map
	 */
	function holmes_mkdf_set_header_expanding_type_global_option( $header_types ) {
		$header_types['header-expanding'] = array(
			'image' => MIKADO_FRAMEWORK_HEADER_TYPES_ROOT . '/header-expanding/assets/img/header-expanding.png',
			'label' => esc_html__( 'Expanding', 'holmes' )
		);

		return $header_types;
	}

	add_filter( 'holmes_mkdf_header_type_global_option', 'holmes_mkdf_set_header_expanding_type_global_option' );
}

if ( ! function_exists( 'holmes_mkdf_set_header_expanding_type_meta_boxes_option' ) ) {
	/**
	 * This function set header type value for header meta boxes map
	 */
	function holmes_mkdf_set_header_expanding_type_meta_boxes_option( $header_type_options ) {
		$header_type_options['header-expanding'] = esc_html__( 'Expanding', 'holmes' );

		return $header_type_options;
	}

	add_filter( 'holmes_mkdf_header_type_meta_boxes', 'holmes_mkdf_set_header_expanding_type_meta_boxes_option' );
}

if ( ! function_exists( 'holmes_mkdf_set_show_dep_options_for_header_expanding' ) ) {
	/**
	 * This function set show container values when this header type is selected for header type global option
	 */
	function holmes_mkdf_set_show_dep_options_for_header_expanding( $show_dep_options ) {
		$show_containers   = array();
		$show_containers[] = '#mkdf_header_behaviour';
		$show_containers[] = '#mkdf_panel_main_menu';
		$show_containers[] = '#mkdf_panel_sticky_header';
		$show_containers[] = '#mkdf_panel_fixed_header';
		$show_containers[] = '#mkdf_header_expanding_area_container';

		$show_containers = apply_filters( 'holmes_mkdf_show_dep_options_for_header_expanding', $show_containers );

		$show_dep_options['header-expanding'] = implode( ',', $show_containers );

		return $show_dep_options;
	}

	add_filter( 'holmes_mkdf_header_type_show_global_option', 'holmes_mkdf_set_show_dep_options_for_header_expanding' );
}

if ( ! function_exists( 'holmes_mkdf_set_hide_dep_options_for_header_expanding' ) ) {
	/**
	 * This function set hide container values when this header type is selected for header type global option
	 */
	function holmes_mkdf_set_hide_dep_options_for_header_expanding( $hide_dep_options ) {
		$hide_containers   = array();
		$hide_containers[] = '#mkdf_panel_fullscreen_menu';
		$hide_containers[] = '#mkdf_logo_area_container';

		$hide_containers = apply_filters( 'holmes_mkdf_hide_dep_options_for_header_expanding', $hide_containers );

		$hide_dep_options['header-expanding'] = implode( ',', $hide_containers );

		return $hide_dep_options;
	}

	add_filter( 'holmes_mkdf_header_type_hide_global_option', 'holmes_mkdf_set_hide_dep_options_for_header_expanding' );
}


if ( ! function_exists( 'holmes_mkdf_set_header_expanding_type_as_global_option' ) ) {
	/**
	 * This function set default header type value for global header option map
	 */
	function holmes_mkdf_set_header_expanding_type_as_global_option( $header_type ) {
		$header_type = 'header-expanding';

		return $header_type;
	}

	add_filter( 'holmes_mkdf_default_header_type_global_option', 'holmes_mkdf_set_header_expanding_type_as_global_option' );
}


if ( ! function_exists( 'holmes_mkdf_set_show_dep_options_for_header_expanding_meta_boxes' ) ) {
	/**
	 * This function set show container values when this header type is selected for header type meta boxes map
	 */
	function holmes_mkdf_set_show_dep_options_for_header_expanding_meta_boxes( $show_dep_options ) {
		$show_containers   = array();
		$show_containers[] = '#mkdf_mkdf_set_expanding_menu_area_position_meta';

		$show_containers = apply_filters( 'holmes_mkdf_show_dep_options_for_header_expanding_meta_boxes', $show_containers );

		$show_dep_options['header-expanding'] = implode( ',', $show_containers );

		return $show_dep_options;
	}

	add_filter( 'holmes_mkdf_header_type_show_meta_boxes', 'holmes_mkdf_set_show_dep_options_for_header_expanding_meta_boxes' );
}

if ( ! function_exists( 'holmes_mkdf_set_hide_dep_options_for_header_expanding_meta_boxes' ) ) {
	/**
	 * This function set hide container values when this header type is selected for header type meta boxes map
	 */
	function holmes_mkdf_set_hide_dep_options_for_header_expanding_meta_boxes( $hide_dep_options ) {
		$hide_containers   = array();
		$hide_containers[] = '#mkdf_mkdf_set_menu_area_position_meta';

		$hide_containers = apply_filters( 'holmes_mkdf_hide_dep_options_for_header_expanding_meta_boxes', $hide_containers );

		$hide_dep_options['header-expanding'] = implode( ',', $hide_containers );

		return $hide_dep_options;
	}

	add_filter( 'holmes_mkdf_header_type_hide_meta_boxes', 'holmes_mkdf_set_hide_dep_options_for_header_expanding_meta_boxes' );
}

if ( ! function_exists( 'holmes_mkdf_set_expanding_hide_dep_options_for_header_types' ) ) {
	/**
	 * This function is used to disable this header type specific containers/panels for admin options when another header type is selected
	 */
	function holmes_mkdf_set_expanding_hide_dep_options_for_header_types( $hide_containers_dep_options ) {
		$hide_containers_dep_options[] = '#mkdf_mkdf_set_expanding_menu_area_position_meta';

		return $hide_containers_dep_options;
	}

	// hide header expanding container for global options
	//add_filter( 'holmes_mkdf_hide_dep_options_for_header_box', 'holmes_mkdf_set_expanding_hide_dep_options_for_header_types' );
	add_filter( 'holmes_mkdf_hide_dep_options_for_header_minimal', 'holmes_mkdf_set_expanding_hide_dep_options_for_header_types' );
	//add_filter( 'holmes_mkdf_hide_dep_options_for_header_standard', 'holmes_mkdf_set_expanding_hide_dep_options_for_header_types' );
	//add_filter( 'holmes_mkdf_hide_dep_options_for_header_vertical', 'holmes_mkdf_set_expanding_hide_dep_options_for_header_types' );

	// hide header expanding container for meta boxes
	//add_filter( 'holmes_mkdf_hide_dep_options_for_header_box_meta_boxes', 'holmes_mkdf_set_expanding_hide_dep_options_for_header_types' );
	add_filter( 'holmes_mkdf_hide_dep_options_for_header_minimal_meta_boxes', 'holmes_mkdf_set_expanding_hide_dep_options_for_header_types' );
	//add_filter( 'holmes_mkdf_hide_dep_options_for_header_standard_meta_boxes', 'holmes_mkdf_set_expanding_hide_dep_options_for_header_types' );
	//add_filter( 'holmes_mkdf_hide_dep_options_for_header_centered_meta_boxes', 'holmes_mkdf_set_expanding_hide_dep_options_for_header_types' );
}

if ( ! function_exists( 'holmes_mkdf_set_hide_dep_options_header_expanding' ) ) {
	/**
	 * This function is used to hide all containers/panels for admin options when this header type is selected
	 */
	function holmes_mkdf_set_hide_dep_options_header_expanding( $hide_dep_options ) {
		$hide_dep_options[] = 'header-expanding';

		return $hide_dep_options;
	}

	// header types panel options
	add_filter( 'holmes_mkdf_full_screen_menu_hide_global_option', 'holmes_mkdf_set_hide_dep_options_header_expanding' );
	//add_filter( 'holmes_mkdf_header_standard_hide_global_option', 'holmes_mkdf_set_hide_dep_options_header_expanding' );
	//add_filter( 'holmes_mkdf_header_vertical_hide_global_option', 'holmes_mkdf_set_hide_dep_options_header_expanding' );
	//add_filter( 'holmes_mkdf_header_vertical_menu_hide_global_option', 'holmes_mkdf_set_hide_dep_options_header_expanding' );

	// header types panel meta boxes
	//add_filter( 'holmes_mkdf_header_standard_hide_meta_boxes', 'holmes_mkdf_set_hide_dep_options_header_expanding' );
	//add_filter( 'holmes_mkdf_header_vertical_hide_meta_boxes', 'holmes_mkdf_set_hide_dep_options_header_expanding' );
}
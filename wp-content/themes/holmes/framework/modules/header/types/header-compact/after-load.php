<?php

if ( ! function_exists( 'holmes_mkdf_header_compact_full_screen_menu_body_class' ) ) {
	/**
	 * Function that adds body classes for different full screen menu types
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function holmes_mkdf_header_compact_full_screen_menu_body_class( $classes ) {
		$classes[] = 'mkdf-' . holmes_mkdf_options()->getOptionValue( 'fullscreen_menu_animation_style' );
		
		return $classes;
	}
	
	if ( holmes_mkdf_check_is_header_type_enabled( 'header-compact', holmes_mkdf_get_page_id() ) ) {
		add_filter( 'body_class', 'holmes_mkdf_header_compact_full_screen_menu_body_class' );
	}
}

//if ( ! function_exists( 'holmes_mkdf_get_header_compact_full_screen_menu' ) ) {
//	/**
//	 * Loads fullscreen menu HTML template
//	 */
//	function holmes_mkdf_get_header_compact_full_screen_menu() {
//		$parameters = array(
//			'fullscreen_menu_in_grid' => holmes_mkdf_options()->getOptionValue( 'fullscreen_in_grid' ) === 'yes' ? true : false
//		);
//
//		holmes_mkdf_get_module_template_part( 'templates/full-screen-menu', 'header/types/header-compact', '', $parameters );
//	}
//
//	if ( holmes_mkdf_check_is_header_type_enabled( 'header-compact', holmes_mkdf_get_page_id() ) ) {
//		add_action( 'holmes_mkdf_after_wrapper_inner', 'holmes_mkdf_get_header_compact_full_screen_menu', 40 );
//	}
//}

//if ( ! function_exists( 'holmes_mkdf_header_compact_mobile_menu_module' ) ) {
//    /**
//     * Function that edits module for mobile menu
//     *
//     * @param $module - default module value
//     *
//     * @return string name of module
//     */
//    function holmes_mkdf_header_compact_mobile_menu_module( $module ) {
//        return 'header/types/header-compact';
//    }
//
//    if ( holmes_mkdf_check_is_header_type_enabled( 'header-compact', holmes_mkdf_get_page_id() ) ) {
//        add_filter('holmes_mkdf_mobile_menu_module', 'holmes_mkdf_header_compact_mobile_menu_module');
//    }
//}

//if ( ! function_exists( 'holmes_mkdf_header_compact_mobile_menu_slug' ) ) {
//    /**
//     * Function that edits slug for mobile menu
//     *
//     * @param $slug - default slug value
//     *
//     * @return string name of slug
//     */
//    function holmes_mkdf_header_compact_mobile_menu_slug( $slug ) {
//        return 'compact';
//    }
//
//    if ( holmes_mkdf_check_is_header_type_enabled( 'header-compact', holmes_mkdf_get_page_id() ) ) {
//        add_filter('holmes_mkdf_mobile_menu_slug', 'holmes_mkdf_header_compact_mobile_menu_slug');
//    }
//}

//if ( ! function_exists( 'holmes_mkdf_header_compact_mobile_menu_parameters' ) ) {
//    /**
//     * Function that edits parameters for mobile menu
//     *
//     * @param $parameters - default parameters array values
//     *
//     * @return array of default values and classes for compact mobile header
//     */
//    function holmes_mkdf_header_compact_mobile_menu_parameters( $parameters ) {
//
//		$parameters['fullscreen_menu_icon_class'] = holmes_mkdf_get_fullscreen_menu_icon_class();
//
//        return $parameters;
//    }
//
//    if ( holmes_mkdf_check_is_header_type_enabled( 'header-compact', holmes_mkdf_get_page_id() ) ) {
//        add_filter('holmes_mkdf_mobile_menu_parameters', 'holmes_mkdf_header_compact_mobile_menu_parameters');
//    }
//}
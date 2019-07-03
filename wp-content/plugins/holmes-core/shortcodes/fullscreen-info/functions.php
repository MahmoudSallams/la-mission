<?php

if ( ! function_exists( 'holmes_core_add_fullscreen_info_shortcodes' ) ) {
	function holmes_core_add_fullscreen_info_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'HolmesCore\CPT\Shortcodes\FullscreenInfo\FullscreenInfo'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'holmes_core_filter_add_vc_shortcode', 'holmes_core_add_fullscreen_info_shortcodes' );
}

if ( ! function_exists( 'holmes_core_set_fullscreen_info_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for fullscreen info shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function holmes_core_set_fullscreen_info_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-fullscreen-info';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'holmes_core_filter_add_vc_shortcodes_custom_icon_class', 'holmes_core_set_fullscreen_info_icon_class_name_for_vc_shortcodes' );
}
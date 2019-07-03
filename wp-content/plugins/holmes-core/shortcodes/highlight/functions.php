<?php

if ( ! function_exists( 'holmes_core_add_highlight_shortcodes' ) ) {
	function holmes_core_add_highlight_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'HolmesCore\CPT\Shortcodes\Highlight\Highlight'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'holmes_core_filter_add_vc_shortcode', 'holmes_core_add_highlight_shortcodes' );
}
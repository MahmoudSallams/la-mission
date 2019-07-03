<?php

if ( ! function_exists( 'holmes_mkdf_register_custom_font_widget' ) ) {
	/**
	 * Function that register custom font widget
	 */
	function holmes_mkdf_register_custom_font_widget( $widgets ) {
		$widgets[] = 'HolmesMkdfCustomFontWidget';
		
		return $widgets;
	}
	
	add_filter( 'holmes_mkdf_register_widgets', 'holmes_mkdf_register_custom_font_widget' );
}
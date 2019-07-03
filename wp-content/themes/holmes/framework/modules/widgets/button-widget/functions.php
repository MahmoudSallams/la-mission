<?php

if ( ! function_exists( 'holmes_mkdf_register_button_widget' ) ) {
	/**
	 * Function that register button widget
	 */
	function holmes_mkdf_register_button_widget( $widgets ) {
		$widgets[] = 'HolmesMkdfButtonWidget';
		
		return $widgets;
	}
	
	add_filter( 'holmes_mkdf_register_widgets', 'holmes_mkdf_register_button_widget' );
}
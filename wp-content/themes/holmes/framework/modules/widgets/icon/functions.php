<?php

if ( ! function_exists( 'holmes_mkdf_register_icon_widget' ) ) {
	/**
	 * Function that register icon widget
	 */
	function holmes_mkdf_register_icon_widget( $widgets ) {
		$widgets[] = 'HolmesMkdfIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'holmes_mkdf_register_widgets', 'holmes_mkdf_register_icon_widget' );
}
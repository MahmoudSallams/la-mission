<?php

if ( ! function_exists( 'holmes_mkdf_register_separator_widget' ) ) {
	/**
	 * Function that register separator widget
	 */
	function holmes_mkdf_register_separator_widget( $widgets ) {
		$widgets[] = 'HolmesMkdfSeparatorWidget';
		
		return $widgets;
	}
	
	add_filter( 'holmes_mkdf_register_widgets', 'holmes_mkdf_register_separator_widget' );
}
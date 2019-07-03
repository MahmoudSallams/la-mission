<?php

if ( ! function_exists( 'holmes_mkdf_register_search_opener_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function holmes_mkdf_register_search_opener_widget( $widgets ) {
		$widgets[] = 'HolmesMkdfSearchOpener';
		
		return $widgets;
	}
	
	add_filter( 'holmes_mkdf_register_widgets', 'holmes_mkdf_register_search_opener_widget' );
}
<?php

if ( ! function_exists( 'holmes_mkdf_register_sidearea_opener_widget' ) ) {
	/**
	 * Function that register sidearea opener widget
	 */
	function holmes_mkdf_register_sidearea_opener_widget( $widgets ) {
		$widgets[] = 'HolmesMkdfSideAreaOpener';
		
		return $widgets;
	}
	
	add_filter( 'holmes_mkdf_register_widgets', 'holmes_mkdf_register_sidearea_opener_widget' );
}
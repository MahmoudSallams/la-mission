<?php

if ( ! function_exists( 'holmes_mkdf_register_sticky_sidebar_widget' ) ) {
	/**
	 * Function that register sticky sidebar widget
	 */
	function holmes_mkdf_register_sticky_sidebar_widget( $widgets ) {
		$widgets[] = 'HolmesMkdfStickySidebar';
		
		return $widgets;
	}
	
	add_filter( 'holmes_mkdf_register_widgets', 'holmes_mkdf_register_sticky_sidebar_widget' );
}
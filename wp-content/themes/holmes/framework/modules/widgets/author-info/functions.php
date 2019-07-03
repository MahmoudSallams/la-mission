<?php

if ( ! function_exists( 'holmes_mkdf_register_author_info_widget' ) ) {
	/**
	 * Function that register author info widget
	 */
	function holmes_mkdf_register_author_info_widget( $widgets ) {
		$widgets[] = 'HolmesMkdfAuthorInfoWidget';
		
		return $widgets;
	}
	
	add_filter( 'holmes_mkdf_register_widgets', 'holmes_mkdf_register_author_info_widget' );
}
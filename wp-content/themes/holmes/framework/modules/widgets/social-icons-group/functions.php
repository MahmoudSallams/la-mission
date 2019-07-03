<?php

if ( ! function_exists( 'holmes_mkdf_register_social_icons_widget' ) ) {
	/**
	 * Function that register social icon widget
	 */
	function holmes_mkdf_register_social_icons_widget( $widgets ) {
		$widgets[] = 'HolmesMkdfClassIconsGroupWidget';
		
		return $widgets;
	}
	
	add_filter( 'holmes_mkdf_register_widgets', 'holmes_mkdf_register_social_icons_widget' );
}
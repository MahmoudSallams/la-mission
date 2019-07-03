<?php

if ( ! function_exists( 'holmes_mkdf_register_social_icon_widget' ) ) {
	/**
	 * Function that register social icon widget
	 */
	function holmes_mkdf_register_social_icon_widget( $widgets ) {
		$widgets[] = 'HolmesMkdfSocialIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'holmes_mkdf_register_widgets', 'holmes_mkdf_register_social_icon_widget' );
}
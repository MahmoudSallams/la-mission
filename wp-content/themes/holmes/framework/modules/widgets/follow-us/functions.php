<?php

if ( ! function_exists( 'holmes_mkdf_register_follow_us_widget' ) ) {
	/**
	 * Function that register follow us widget
	 */
	function holmes_mkdf_register_follow_us_widget( $widgets ) {
		$widgets[] = 'HolmesMkdfFollowUsWidget';

		return $widgets;
	}

	add_filter( 'holmes_mkdf_register_widgets', 'holmes_mkdf_register_follow_us_widget' );
}
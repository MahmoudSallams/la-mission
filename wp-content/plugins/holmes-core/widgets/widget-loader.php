<?php

if ( ! function_exists( 'holmes_mkdf_register_widgets' ) ) {
	function holmes_mkdf_register_widgets() {
		$widgets = apply_filters( 'holmes_mkdf_register_widgets', $widgets = array() );

		foreach ( $widgets as $widget ) {
			register_widget( $widget );
		}
	}

	add_action( 'widgets_init', 'holmes_mkdf_register_widgets' );
}
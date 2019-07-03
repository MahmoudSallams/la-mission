<?php

if ( ! function_exists( 'holmes_mkdf_set_title_tagline_type_for_options' ) ) {
	/**
	 * This function set tagline title type value for title options map and meta boxes
	 */
	function holmes_mkdf_set_title_tagline_type_for_options( $type ) {
		$type['tagline'] = esc_html__( 'Tagline', 'holmes' );

		return $type;
	}

	add_filter( 'holmes_mkdf_title_type_global_option', 'holmes_mkdf_set_title_tagline_type_for_options' );
	add_filter( 'holmes_mkdf_title_type_meta_boxes', 'holmes_mkdf_set_title_tagline_type_for_options' );
}
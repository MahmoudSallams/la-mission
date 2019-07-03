<?php

if ( ! function_exists( 'holmes_mkdf_set_hide_dep_options_title_tagline' ) ) {
	/**
	 * This function is used to hide all containers/panels for admin options when this title type is selected
	 */
	function holmes_mkdf_set_hide_dep_options_title_tagline( $hide_dep_options ) {
		$hide_dep_options[] = 'tagline';

		return $hide_dep_options;
	}

	// hide tagline meta
	add_filter( 'holmes_mkdf_breadcrumbs_title_hide_meta_boxes', 'holmes_mkdf_set_hide_dep_options_title_tagline' );
}
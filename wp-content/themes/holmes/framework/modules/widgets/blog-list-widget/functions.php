<?php

if ( ! function_exists( 'holmes_mkdf_register_blog_list_widget' ) ) {
	/**
	 * Function that register blog list widget
	 */
	function holmes_mkdf_register_blog_list_widget( $widgets ) {
		$widgets[] = 'HolmesMkdfBlogListWidget';
		
		return $widgets;
	}
	
	add_filter( 'holmes_mkdf_register_widgets', 'holmes_mkdf_register_blog_list_widget' );
}
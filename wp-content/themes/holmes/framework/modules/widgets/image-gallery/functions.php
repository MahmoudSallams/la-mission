<?php

if ( ! function_exists( 'holmes_mkdf_register_image_gallery_widget' ) ) {
	/**
	 * Function that register image gallery widget
	 */
	function holmes_mkdf_register_image_gallery_widget( $widgets ) {
		$widgets[] = 'HolmesMkdfImageGalleryWidget';
		
		return $widgets;
	}
	
	add_filter( 'holmes_mkdf_register_widgets', 'holmes_mkdf_register_image_gallery_widget' );
}
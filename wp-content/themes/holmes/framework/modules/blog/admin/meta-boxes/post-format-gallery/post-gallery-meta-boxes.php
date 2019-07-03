<?php

if ( ! function_exists( 'holmes_mkdf_map_post_gallery_meta' ) ) {
	
	function holmes_mkdf_map_post_gallery_meta() {
		$gallery_post_format_meta_box = holmes_mkdf_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Gallery Post Format', 'holmes' ),
				'name'  => 'post_format_gallery_meta'
			)
		);
		
		holmes_mkdf_add_multiple_images_field(
			array(
				'name'        => 'mkdf_post_gallery_images_meta',
				'label'       => esc_html__( 'Gallery Images', 'holmes' ),
				'description' => esc_html__( 'Choose your gallery images', 'holmes' ),
				'parent'      => $gallery_post_format_meta_box,
			)
		);
	}
	
	add_action( 'holmes_mkdf_meta_boxes_map', 'holmes_mkdf_map_post_gallery_meta', 21 );
}

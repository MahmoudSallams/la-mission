<?php

if ( ! function_exists( 'holmes_mkdf_map_post_link_meta' ) ) {
	function holmes_mkdf_map_post_link_meta() {
		$link_post_format_meta_box = holmes_mkdf_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Link Post Format', 'holmes' ),
				'name'  => 'post_format_link_meta'
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_post_link_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Link', 'holmes' ),
				'description' => esc_html__( 'Enter link', 'holmes' ),
				'parent'      => $link_post_format_meta_box
			)
		);
	}
	
	add_action( 'holmes_mkdf_meta_boxes_map', 'holmes_mkdf_map_post_link_meta', 24 );
}
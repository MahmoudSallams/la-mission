<?php

if ( ! function_exists( 'holmes_mkdf_map_post_quote_meta' ) ) {
	function holmes_mkdf_map_post_quote_meta() {
		$quote_post_format_meta_box = holmes_mkdf_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Quote Post Format', 'holmes' ),
				'name'  => 'post_format_quote_meta'
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_post_quote_text_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Text', 'holmes' ),
				'description' => esc_html__( 'Enter Quote text', 'holmes' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_post_quote_author_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Author', 'holmes' ),
				'description' => esc_html__( 'Enter Quote author', 'holmes' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
	}
	
	add_action( 'holmes_mkdf_meta_boxes_map', 'holmes_mkdf_map_post_quote_meta', 25 );
}
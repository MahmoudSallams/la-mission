<?php

if ( ! function_exists( 'holmes_core_map_testimonials_meta' ) ) {
	function holmes_core_map_testimonials_meta() {
		$testimonial_meta_box = holmes_mkdf_create_meta_box(
			array(
				'scope' => array( 'testimonials' ),
				'title' => esc_html__( 'Testimonial', 'holmes-core' ),
				'name'  => 'testimonial_meta'
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_title',
				'type'        => 'text',
				'label'       => esc_html__( 'Title', 'holmes-core' ),
				'description' => esc_html__( 'Enter testimonial title', 'holmes-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_text',
				'type'        => 'text',
				'label'       => esc_html__( 'Text', 'holmes-core' ),
				'description' => esc_html__( 'Enter testimonial text', 'holmes-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_author',
				'type'        => 'text',
				'label'       => esc_html__( 'Author', 'holmes-core' ),
				'description' => esc_html__( 'Enter author name', 'holmes-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_author_position',
				'type'        => 'text',
				'label'       => esc_html__( 'Author Position', 'holmes-core' ),
				'description' => esc_html__( 'Enter author job position', 'holmes-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
	}
	
	add_action( 'holmes_mkdf_meta_boxes_map', 'holmes_core_map_testimonials_meta', 95 );
}
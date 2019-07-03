<?php

if ( ! function_exists( 'holmes_mkdf_logo_meta_box_map' ) ) {
	function holmes_mkdf_logo_meta_box_map() {
		
		$logo_meta_box = holmes_mkdf_create_meta_box(
			array(
				'scope' => apply_filters( 'holmes_mkdf_set_scope_for_meta_boxes', array( 'page', 'post' ), 'logo_meta' ),
				'title' => esc_html__( 'Logo', 'holmes' ),
				'name'  => 'logo_meta'
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Default', 'holmes' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'holmes' ),
				'parent'      => $logo_meta_box
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_dark_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Dark', 'holmes' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'holmes' ),
				'parent'      => $logo_meta_box
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_light_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Light', 'holmes' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'holmes' ),
				'parent'      => $logo_meta_box
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_sticky_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Sticky', 'holmes' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'holmes' ),
				'parent'      => $logo_meta_box
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_mobile_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Mobile', 'holmes' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'holmes' ),
				'parent'      => $logo_meta_box
			)
		);
	}
	
	add_action( 'holmes_mkdf_meta_boxes_map', 'holmes_mkdf_logo_meta_box_map', 47 );
}
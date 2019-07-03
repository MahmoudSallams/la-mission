<?php

if ( ! function_exists( 'holmes_mkdf_sticky_header_meta_boxes_options_map' ) ) {
	function holmes_mkdf_sticky_header_meta_boxes_options_map( $header_meta_box ) {
		
		$sticky_amount_container = holmes_mkdf_add_admin_container(
			array(
				'parent'          => $header_meta_box,
				'name'            => 'sticky_amount_container_meta_container',
				'dependency' => array(
					'hide' => array(
						'mkdf_header_behaviour_meta'  => array( '', 'no-behavior','fixed-on-scroll','sticky-header-on-scroll-up' )
					)
				)
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_scroll_amount_for_sticky_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Scroll Amount for Sticky Header Appearance', 'holmes' ),
				'description' => esc_html__( 'Define scroll amount for sticky header appearance', 'holmes' ),
				'parent'      => $sticky_amount_container,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px'
				)
			)
		);
		
		$holmes_custom_sidebars = holmes_mkdf_get_custom_sidebars();
		if ( count( $holmes_custom_sidebars ) > 0 ) {
			holmes_mkdf_create_meta_box_field(
				array(
					'name'        => 'mkdf_custom_sticky_menu_area_sidebar_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Custom Widget Area In Sticky Header Menu Area', 'holmes' ),
					'description' => esc_html__( 'Choose custom widget area to display in sticky header menu area"', 'holmes' ),
					'parent'      => $header_meta_box,
					'options'     => $holmes_custom_sidebars,
					'dependency' => array(
						'show' => array(
							'mkdf_header_behaviour_meta' => array( 'sticky-header-on-scroll-up', 'sticky-header-on-scroll-down-up' )
						)
					)
				)
			);
		}
	}
	
	add_action( 'holmes_mkdf_additional_header_area_meta_boxes_map', 'holmes_mkdf_sticky_header_meta_boxes_options_map', 8, 1 );
}
<?php

if ( ! function_exists( 'holmes_mkdf_map_sidebar_meta' ) ) {
	function holmes_mkdf_map_sidebar_meta() {
		$mkdf_sidebar_meta_box = holmes_mkdf_create_meta_box(
			array(
				'scope' => apply_filters( 'holmes_mkdf_set_scope_for_meta_boxes', array( 'page' ), 'sidebar_meta' ),
				'title' => esc_html__( 'Sidebar', 'holmes' ),
				'name'  => 'sidebar_meta'
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_sidebar_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Sidebar Layout', 'holmes' ),
				'description' => esc_html__( 'Choose the sidebar layout', 'holmes' ),
				'parent'      => $mkdf_sidebar_meta_box,
                'options'       => holmes_mkdf_get_custom_sidebars_options( true )
			)
		);
		
		$mkdf_custom_sidebars = holmes_mkdf_get_custom_sidebars();
		if ( count( $mkdf_custom_sidebars ) > 0 ) {
			holmes_mkdf_create_meta_box_field(
				array(
					'name'        => 'mkdf_custom_sidebar_area_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Widget Area in Sidebar', 'holmes' ),
					'description' => esc_html__( 'Choose Custom Widget area to display in Sidebar"', 'holmes' ),
					'parent'      => $mkdf_sidebar_meta_box,
					'options'     => $mkdf_custom_sidebars,
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
	}
	
	add_action( 'holmes_mkdf_meta_boxes_map', 'holmes_mkdf_map_sidebar_meta', 31 );
}
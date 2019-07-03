<?php

if ( ! function_exists( 'holmes_mkdf_get_hide_dep_for_header_widget_areas_meta_boxes' ) ) {
	function holmes_mkdf_get_hide_dep_for_header_widget_areas_meta_boxes() {
		$hide_dep_options = apply_filters( 'holmes_mkdf_header_widget_areas_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'holmes_mkdf_get_hide_dep_for_header_widget_area_two_meta_boxes' ) ) {
	function holmes_mkdf_get_hide_dep_for_header_widget_area_two_meta_boxes() {
		$hide_dep_options = apply_filters( 'holmes_mkdf_header_widget_area_two_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'holmes_mkdf_header_widget_areas_meta_options_map' ) ) {
	function holmes_mkdf_header_widget_areas_meta_options_map( $header_meta_box ) {
		$hide_dep_widgets 			= holmes_mkdf_get_hide_dep_for_header_widget_areas_meta_boxes();
		$hide_dep_widget_area_two 	= holmes_mkdf_get_hide_dep_for_header_widget_area_two_meta_boxes();
		
		$header_widget_areas_container = holmes_mkdf_add_admin_container_no_style(
			array(
				'type'       => 'container',
				'name'       => 'header_widget_areas_container',
				'parent'     => $header_meta_box,
				'dependency' => array(
					'hide' => array(
						'mkdf_header_type_meta' => $hide_dep_widgets
					)
				),
				'args'       => array(
					'enable_panels_for_default_value' => true
				)
			)
		);
		
		holmes_mkdf_add_admin_section_title(
			array(
				'parent' => $header_widget_areas_container,
				'name'   => 'header_widget_areas',
				'title'  => esc_html__( 'Widget Areas', 'holmes' )
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_disable_header_widget_areas_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Disable Header Widget Areas', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will hide widget areas from header', 'holmes' ),
				'parent'        => $header_widget_areas_container,
			)
		);

		$header_custom_widget_areas_container = holmes_mkdf_add_admin_container_no_style(
			array(
				'type'       => 'container',
				'name'       => 'header_custom_widget_areas_container',
				'parent'     => $header_widget_areas_container,
				'dependency' => array(
					'hide' => array(
						'mkdf_disable_header_widget_areas_meta' => 'yes'
					)
				)
			)
		);
					
		$holmes_custom_sidebars = holmes_mkdf_get_custom_sidebars();
		if ( count( $holmes_custom_sidebars ) > 0 ) {
			holmes_mkdf_create_meta_box_field(
				array(
					'name'        => 'mkdf_custom_header_widget_area_one_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Custom Header Widget Area One', 'holmes' ),
					'description' => esc_html__( 'Choose custom widget area to display in header widget area one', 'holmes' ),
					'parent'      => $header_custom_widget_areas_container,
					'options'     => $holmes_custom_sidebars
				)
			);
		}

		//if ( count( $holmes_custom_sidebars ) > 0 ) {
		//	holmes_mkdf_create_meta_box_field(
		//		array(
		//			'name'        => 'mkdf_custom_header_widget_area_two_meta',
		//			'type'        => 'selectblank',
		//			'label'       => esc_html__( 'Choose Custom Header Widget Area Two', 'holmes' ),
		//			'description' => esc_html__( 'Choose custom widget area to display in header widget area two', 'holmes' ),
		//			'parent'      => $header_custom_widget_areas_container,
		//			'options'     => $holmes_custom_sidebars,
		//			'dependency' => array(
		//				'hide' => array(
		//					'mkdf_header_type_meta' => $hide_dep_widget_area_two
		//				)
		//			)
		//		)
		//	);
		//}
		
		do_action( 'holmes_mkdf_header_widget_areas_additional_meta_boxes_map', $header_widget_areas_container );
	}
	
	add_action( 'holmes_mkdf_header_widget_areas_meta_boxes_map', 'holmes_mkdf_header_widget_areas_meta_options_map', 10, 1 );
}
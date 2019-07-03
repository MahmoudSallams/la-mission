<?php

if ( ! function_exists( 'holmes_mkdf_header_types_meta_boxes' ) ) {
	function holmes_mkdf_header_types_meta_boxes() {
		$header_type_options = apply_filters( 'holmes_mkdf_header_type_meta_boxes', $header_type_options = array( '' => esc_html__( 'Default', 'holmes' ) ) );
		
		return $header_type_options;
	}
}

if ( ! function_exists( 'holmes_mkdf_get_hide_dep_for_header_behavior_meta_boxes' ) ) {
	function holmes_mkdf_get_hide_dep_for_header_behavior_meta_boxes() {
		$hide_dep_options = apply_filters( 'holmes_mkdf_header_behavior_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

foreach ( glob( MIKADO_FRAMEWORK_HEADER_ROOT_DIR . '/admin/meta-boxes/*/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

foreach ( glob( MIKADO_FRAMEWORK_HEADER_TYPES_ROOT_DIR . '/*/admin/meta-boxes/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'holmes_mkdf_map_header_meta' ) ) {
	function holmes_mkdf_map_header_meta() {
		$header_type_meta_boxes              = holmes_mkdf_header_types_meta_boxes();
		$header_behavior_meta_boxes_hide_dep = holmes_mkdf_get_hide_dep_for_header_behavior_meta_boxes();
		
		$header_meta_box = holmes_mkdf_create_meta_box(
			array(
				'scope' => apply_filters( 'holmes_mkdf_set_scope_for_meta_boxes', array( 'page', 'post' ), 'header_meta' ),
				'title' => esc_html__( 'Header', 'holmes' ),
				'name'  => 'header_meta'
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_header_type_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Choose Header Type', 'holmes' ),
				'description'   => esc_html__( 'Select header type layout', 'holmes' ),
				'parent'        => $header_meta_box,
				'options'       => $header_type_meta_boxes
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_header_style_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Header Skin', 'holmes' ),
				'description'   => esc_html__( 'Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style', 'holmes' ),
				'parent'        => $header_meta_box,
				'options'       => array(
					''             => esc_html__( 'Default', 'holmes' ),
					'light-header' => esc_html__( 'Light', 'holmes' ),
					'dark-header'  => esc_html__( 'Dark', 'holmes' )
				)
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'parent'          => $header_meta_box,
				'type'            => 'select',
				'name'            => 'mkdf_header_behaviour_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Choose Header Behaviour', 'holmes' ),
				'description'     => esc_html__( 'Select the behaviour of header when you scroll down to page', 'holmes' ),
				'options'         => array(
					''                                => esc_html__( 'Default', 'holmes' ),
					'fixed-on-scroll'                 => esc_html__( 'Fixed on scroll', 'holmes' ),
					'no-behavior'                     => esc_html__( 'No Behavior', 'holmes' ),
					'sticky-header-on-scroll-up'      => esc_html__( 'Sticky on scroll up', 'holmes' ),
					'sticky-header-on-scroll-down-up' => esc_html__( 'Sticky on scroll up/down', 'holmes' )
				),
				'dependency' => array(
					'hide' => array(
						'mkdf_header_type_meta'  => $header_behavior_meta_boxes_hide_dep
					)
				)
			)
		);
		
		//additional area
		do_action( 'holmes_mkdf_additional_header_area_meta_boxes_map', $header_meta_box );
		
		//top area
		do_action( 'holmes_mkdf_header_top_area_meta_boxes_map', $header_meta_box );
		
		//logo area
		do_action( 'holmes_mkdf_header_logo_area_meta_boxes_map', $header_meta_box );
		
		//menu area
		do_action( 'holmes_mkdf_header_menu_area_meta_boxes_map', $header_meta_box );

		//dropdown
		do_action( 'holmes_mkdf_dropdown_meta_boxes_map', $header_meta_box );

		//widget areaa
		do_action( 'holmes_mkdf_header_widget_areas_meta_boxes_map', $header_meta_box );
	}
	
	add_action( 'holmes_mkdf_meta_boxes_map', 'holmes_mkdf_map_header_meta', 50 );
}
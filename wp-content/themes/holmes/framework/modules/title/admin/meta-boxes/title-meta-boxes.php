<?php

if ( ! function_exists( 'holmes_mkdf_get_title_types_meta_boxes' ) ) {
	function holmes_mkdf_get_title_types_meta_boxes() {
		$title_type_options = apply_filters( 'holmes_mkdf_title_type_meta_boxes', $title_type_options = array( '' => esc_html__( 'Default', 'holmes' ) ) );

		return $title_type_options;
	}
}

foreach ( glob( MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/admin/meta-boxes/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'holmes_mkdf_map_title_meta' ) ) {
	function holmes_mkdf_map_title_meta() {
		$title_type_meta_boxes = holmes_mkdf_get_title_types_meta_boxes();

		$title_meta_box = holmes_mkdf_create_meta_box(
			array(
				'scope' => apply_filters( 'holmes_mkdf_set_scope_for_meta_boxes', array(
					'page',
					'post'
				), 'title_meta' ),
				'title' => esc_html__( 'Title', 'holmes' ),
				'name'  => 'title_meta'
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_show_title_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'holmes' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'holmes' ),
				'parent'        => $title_meta_box,
				'options'       => holmes_mkdf_get_yes_no_select_array()
			)
		);

		$show_title_area_meta_container = holmes_mkdf_add_admin_container(
			array(
				'parent'     => $title_meta_box,
				'name'       => 'mkdf_show_title_area_meta_container',
				'dependency' => array(
					'hide' => array(
						'mkdf_show_title_area_meta' => 'no'
					)
				)
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_title_area_type_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Title Area Type', 'holmes' ),
				'description'   => esc_html__( 'Choose title type', 'holmes' ),
				'parent'        => $show_title_area_meta_container,
				'options'       => $title_type_meta_boxes
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_title_area_in_grid_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Title Area In Grid', 'holmes' ),
				'description'   => esc_html__( 'Set title area content to be in grid', 'holmes' ),
				'options'       => holmes_mkdf_get_yes_no_select_array(),
				'parent'        => $show_title_area_meta_container
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_title_area_full_height_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Full Height', 'holmes' ),
				'description'   => esc_html__( 'Set a height for Title Area to full height ', 'holmes' ),
				'options'       => holmes_mkdf_get_yes_no_select_array(),
				'parent'        => $show_title_area_meta_container
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_title_area_height_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Height', 'holmes' ),
				'description' => esc_html__( 'Set a height for Title Area', 'holmes' ),
				'parent'      => $show_title_area_meta_container,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px'
				),
				'dependency'  => array(
					'hide' => array(
						'mkdf_title_area_full_height_meta' => 'yes'
					)
				)
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_title_area_pattern_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Pattern', 'holmes' ),
				'description'   => esc_html__( 'Apply pattern over Title Area', 'holmes' ),
				'options'       => holmes_mkdf_get_yes_no_select_array(),
				'parent'        => $show_title_area_meta_container
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_title_area_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'holmes' ),
				'description' => esc_html__( 'Choose a background color for title area', 'holmes' ),
				'parent'      => $show_title_area_meta_container
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_title_area_background_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Background Image', 'holmes' ),
				'description' => esc_html__( 'Choose an Image for title area', 'holmes' ),
				'parent'      => $show_title_area_meta_container
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_title_area_background_image_behavior_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Background Image Behavior', 'holmes' ),
				'description'   => esc_html__( 'Choose title area background image behavior', 'holmes' ),
				'parent'        => $show_title_area_meta_container,
				'options'       => array(
					''                    => esc_html__( 'Default', 'holmes' ),
					'hide'                => esc_html__( 'Hide Image', 'holmes' ),
					'responsive'          => esc_html__( 'Enable Responsive Image', 'holmes' ),
					'responsive-disabled' => esc_html__( 'Disable Responsive Image', 'holmes' ),
					'parallax'            => esc_html__( 'Enable Parallax Image', 'holmes' ),
					'parallax-zoom-out'   => esc_html__( 'Enable Parallax With Zoom Out Image', 'holmes' ),
					'parallax-disabled'   => esc_html__( 'Disable Parallax Image', 'holmes' )
				)
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_title_area_vertical_alignment_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Vertical Alignment', 'holmes' ),
				'description'   => esc_html__( 'Specify title area content vertical alignment', 'holmes' ),
				'parent'        => $show_title_area_meta_container,
				'options'       => array(
					''                     => esc_html__( 'Default', 'holmes' ),
					'center-header-bottom' => esc_html__( 'Center From Bottom of Header', 'holmes' ),
					'center'               => esc_html__( 'Center', 'holmes' ),
					'top-header-bottom'    => esc_html__( 'Top From Bottom of Header', 'holmes' ),
					'top'                  => esc_html__( 'Top', 'holmes' ),
				)
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_title_area_title_tag_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Title Tag', 'holmes' ),
				'options'       => holmes_mkdf_get_title_tag( true ),
				'parent'        => $show_title_area_meta_container
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_title_text_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Title Color', 'holmes' ),
				'description' => esc_html__( 'Choose a color for title text', 'holmes' ),
				'parent'      => $show_title_area_meta_container
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_title_area_subtitle_meta',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__( 'Subtitle Text', 'holmes' ),
				'description'   => esc_html__( 'Enter your subtitle text', 'holmes' ),
				'parent'        => $show_title_area_meta_container,
				'args'          => array(
					'col_width' => 6
				)
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_title_area_subtitle_tag_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Subtitle Tag', 'holmes' ),
				'options'       => holmes_mkdf_get_title_tag( true, array( 'p' => 'p' ) ),
				'parent'        => $show_title_area_meta_container
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_subtitle_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Subtitle Color', 'holmes' ),
				'description' => esc_html__( 'Choose a color for subtitle text', 'holmes' ),
				'parent'      => $show_title_area_meta_container
			)
		);

		/***************** Additional Title Area Layout - start *****************/

		do_action( 'holmes_mkdf_additional_title_area_meta_boxes', $show_title_area_meta_container );

		/***************** Additional Title Area Layout - end *****************/

	}

	add_action( 'holmes_mkdf_meta_boxes_map', 'holmes_mkdf_map_title_meta', 60 );
}
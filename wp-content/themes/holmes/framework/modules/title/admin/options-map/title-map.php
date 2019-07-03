<?php

if ( ! function_exists( 'holmes_mkdf_get_title_types_options' ) ) {
	function holmes_mkdf_get_title_types_options() {
		$title_type_options = apply_filters( 'holmes_mkdf_title_type_global_option', $title_type_options = array() );

		return $title_type_options;
	}
}

if ( ! function_exists( 'holmes_mkdf_get_title_type_default_options' ) ) {
	function holmes_mkdf_get_title_type_default_options() {
		$title_type_option = apply_filters( 'holmes_mkdf_default_title_type_global_option', $title_type_option = '' );

		return $title_type_option;
	}
}

foreach ( glob( MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/admin/options-map/*.php' ) as $options_load ) {
	include_once $options_load;
}

if ( ! function_exists( 'holmes_mkdf_title_options_map' ) ) {
	function holmes_mkdf_title_options_map() {
		$title_type_options        = holmes_mkdf_get_title_types_options();
		$title_type_default_option = holmes_mkdf_get_title_type_default_options();

		holmes_mkdf_add_admin_page(
			array(
				'slug'  => '_title_page',
				'title' => esc_html__( 'Title', 'holmes' ),
				'icon'  => 'fa fa-list-alt'
			)
		);

		$panel_title = holmes_mkdf_add_admin_panel(
			array(
				'page'  => '_title_page',
				'name'  => 'panel_title',
				'title' => esc_html__( 'Title Settings', 'holmes' )
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'show_title_area',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Title Area', 'holmes' ),
				'description'   => esc_html__( 'This option will enable/disable Title Area', 'holmes' ),
				'parent'        => $panel_title
			)
		);

		$show_title_area_container = holmes_mkdf_add_admin_container(
			array(
				'parent'     => $panel_title,
				'name'       => 'show_title_area_container',
				'dependency' => array(
					'show' => array(
						'show_title_area' => 'yes'
					)
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'title_area_type',
				'type'          => 'select',
				'default_value' => $title_type_default_option,
				'label'         => esc_html__( 'Title Area Type', 'holmes' ),
				'description'   => esc_html__( 'Choose title type', 'holmes' ),
				'parent'        => $show_title_area_container,
				'options'       => $title_type_options
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'title_area_in_grid',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Title Area In Grid', 'holmes' ),
				'description'   => esc_html__( 'Set title area content to be in grid', 'holmes' ),
				'parent'        => $show_title_area_container
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'title_area_full_height',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Full Height', 'holmes' ),
				'description'   => esc_html__( 'Set a height for Title Area to full height ', 'holmes' ),
				'parent'        => $show_title_area_container
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'        => 'title_area_height',
				'type'        => 'text',
				'label'       => esc_html__( 'Height', 'holmes' ),
				'description' => esc_html__( 'Set a height for Title Area', 'holmes' ),
				'parent'      => $show_title_area_container,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px'
				),
				'dependency'  => array(
					'hide' => array(
						'title_area_full_height' => 'yes'
					)
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'title_area_pattern',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Pattern', 'holmes' ),
				'description'   => esc_html__( 'Apply pattern over Title Area', 'holmes' ),
				'parent'        => $show_title_area_container
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'        => 'title_area_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'holmes' ),
				'description' => esc_html__( 'Choose a background color for Title Area', 'holmes' ),
				'parent'      => $show_title_area_container
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'        => 'title_area_background_image',
				'type'        => 'image',
				'label'       => esc_html__( 'Background Image', 'holmes' ),
				'description' => esc_html__( 'Choose an Image for Title Area', 'holmes' ),
				'parent'      => $show_title_area_container
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'title_area_background_image_behavior',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Background Image Behavior', 'holmes' ),
				'description'   => esc_html__( 'Choose title area background image behavior', 'holmes' ),
				'parent'        => $show_title_area_container,
				'options'       => array(
					''                  => esc_html__( 'Default', 'holmes' ),
					'responsive'        => esc_html__( 'Enable Responsive Image', 'holmes' ),
					'parallax'          => esc_html__( 'Enable Parallax Image', 'holmes' ),
					'parallax-zoom-out' => esc_html__( 'Enable Parallax With Zoom Out Image', 'holmes' )
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'title_area_vertical_alignment',
				'type'          => 'select',
				'default_value' => 'center-header-bottom',
				'label'         => esc_html__( 'Vertical Alignment', 'holmes' ),
				'description'   => esc_html__( 'Specify title vertical alignment', 'holmes' ),
				'parent'        => $show_title_area_container,
				'options'       => array(
					'center-header-bottom' => esc_html__( 'Center From Bottom of Header', 'holmes' ),
					'center'               => esc_html__( 'Center', 'holmes' ),
					'top-header-bottom'    => esc_html__( 'Top From Bottom of Header', 'holmes' ),
					'top'                  => esc_html__( 'Top', 'holmes' ),
				)
			)
		);

		/***************** Additional Title Area Layout - start *****************/

		do_action( 'holmes_mkdf_additional_title_area_options_map', $show_title_area_container );

		/***************** Additional Title Area Layout - end *****************/


		$panel_typography = holmes_mkdf_add_admin_panel(
			array(
				'page'  => '_title_page',
				'name'  => 'panel_title_typography',
				'title' => esc_html__( 'Typography', 'holmes' )
			)
		);

		holmes_mkdf_add_admin_section_title(
			array(
				'name'   => 'type_section_title',
				'title'  => esc_html__( 'Title', 'holmes' ),
				'parent' => $panel_typography
			)
		);

		$group_page_title_styles = holmes_mkdf_add_admin_group(
			array(
				'name'        => 'group_page_title_styles',
				'title'       => esc_html__( 'Title', 'holmes' ),
				'description' => esc_html__( 'Define styles for page title', 'holmes' ),
				'parent'      => $panel_typography
			)
		);

		$row_page_title_styles_1 = holmes_mkdf_add_admin_row(
			array(
				'name'   => 'row_page_title_styles_1',
				'parent' => $group_page_title_styles
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'title_area_title_tag',
				'type'          => 'selectsimple',
				'default_value' => 'h1',
				'label'         => esc_html__( 'Title Tag', 'holmes' ),
				'options'       => holmes_mkdf_get_title_tag(),
				'parent'        => $row_page_title_styles_1
			)
		);

		$row_page_title_styles_2 = holmes_mkdf_add_admin_row(
			array(
				'name'   => 'row_page_title_styles_2',
				'parent' => $group_page_title_styles
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'   => 'colorsimple',
				'name'   => 'page_title_color',
				'label'  => esc_html__( 'Text Color', 'holmes' ),
				'parent' => $row_page_title_styles_2
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'page_title_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'holmes' ),
				'parent'        => $row_page_title_styles_2,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'page_title_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'holmes' ),
				'parent'        => $row_page_title_styles_2,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'page_title_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'holmes' ),
				'options'       => holmes_mkdf_get_text_transform_array(),
				'parent'        => $row_page_title_styles_2
			)
		);

		$row_page_title_styles_3 = holmes_mkdf_add_admin_row(
			array(
				'name'   => 'row_page_title_styles_3',
				'parent' => $group_page_title_styles,
				'next'   => true
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'fontsimple',
				'name'          => 'page_title_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'holmes' ),
				'parent'        => $row_page_title_styles_3
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'page_title_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'holmes' ),
				'options'       => holmes_mkdf_get_font_style_array(),
				'parent'        => $row_page_title_styles_3
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'page_title_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'holmes' ),
				'options'       => holmes_mkdf_get_font_weight_array(),
				'parent'        => $row_page_title_styles_3
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'page_title_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'holmes' ),
				'parent'        => $row_page_title_styles_3,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		holmes_mkdf_add_admin_section_title(
			array(
				'name'   => 'type_section_subtitle',
				'title'  => esc_html__( 'Subtitle', 'holmes' ),
				'parent' => $panel_typography
			)
		);

		$group_page_subtitle_styles = holmes_mkdf_add_admin_group(
			array(
				'name'        => 'group_page_subtitle_styles',
				'title'       => esc_html__( 'Subtitle', 'holmes' ),
				'description' => esc_html__( 'Define styles for page subtitle', 'holmes' ),
				'parent'      => $panel_typography
			)
		);

		$row_page_subtitle_styles_1 = holmes_mkdf_add_admin_row(
			array(
				'name'   => 'row_page_subtitle_styles_1',
				'parent' => $group_page_subtitle_styles
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'title_area_subtitle_tag',
				'type'          => 'selectsimple',
				'default_value' => 'h6',
				'label'         => esc_html__( 'Subtitle Tag', 'holmes' ),
				'options'       => holmes_mkdf_get_title_tag(),
				'parent'        => $row_page_subtitle_styles_1
			)
		);

		$row_page_subtitle_styles_2 = holmes_mkdf_add_admin_row(
			array(
				'name'   => 'row_page_subtitle_styles_2',
				'parent' => $group_page_subtitle_styles
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'   => 'colorsimple',
				'name'   => 'page_subtitle_color',
				'label'  => esc_html__( 'Text Color', 'holmes' ),
				'parent' => $row_page_subtitle_styles_2
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'page_subtitle_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'holmes' ),
				'parent'        => $row_page_subtitle_styles_2,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'page_subtitle_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'holmes' ),
				'parent'        => $row_page_subtitle_styles_2,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'page_subtitle_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'holmes' ),
				'options'       => holmes_mkdf_get_text_transform_array(),
				'parent'        => $row_page_subtitle_styles_2
			)
		);

		$row_page_subtitle_styles_3 = holmes_mkdf_add_admin_row(
			array(
				'name'   => 'row_page_subtitle_styles_3',
				'parent' => $group_page_subtitle_styles,
				'next'   => true
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'fontsimple',
				'name'          => 'page_subtitle_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'holmes' ),
				'parent'        => $row_page_subtitle_styles_3
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'page_subtitle_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'holmes' ),
				'options'       => holmes_mkdf_get_font_style_array(),
				'parent'        => $row_page_subtitle_styles_3
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'page_subtitle_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'holmes' ),
				'options'       => holmes_mkdf_get_font_weight_array(),
				'parent'        => $row_page_subtitle_styles_3
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'page_subtitle_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'holmes' ),
				'args'          => array(
					'suffix' => 'px'
				),
				'parent'        => $row_page_subtitle_styles_3
			)
		);

		/***************** Additional Title Typography Layout - start *****************/

		do_action( 'holmes_mkdf_additional_title_typography_options_map', $panel_typography );

		/***************** Additional Title Typography Layout - end *****************/
	}

	add_action( 'holmes_mkdf_options_map', 'holmes_mkdf_title_options_map', holmes_mkdf_set_options_map_position( 'title' ) );
}
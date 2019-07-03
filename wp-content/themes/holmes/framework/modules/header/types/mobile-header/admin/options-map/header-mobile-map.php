<?php

if ( ! function_exists( 'holmes_mkdf_mobile_header_options_map' ) ) {
	function holmes_mkdf_mobile_header_options_map() {
		
		holmes_mkdf_add_admin_page(
			array(
				'slug'  => '_mobile_header',
				'title' => esc_html__( 'Mobile Header', 'holmes' ),
				'icon'  => 'fa fa-mobile'
			)
		);
		
		$panel_mobile_header = holmes_mkdf_add_admin_panel(
			array(
				'title' => esc_html__( 'Mobile Header', 'holmes' ),
				'name'  => 'panel_mobile_header',
				'page'  => '_mobile_header'
			)
		);
		
		$mobile_header_group = holmes_mkdf_add_admin_group(
			array(
				'parent' => $panel_mobile_header,
				'name'   => 'mobile_header_group',
				'title'  => esc_html__( 'Mobile Header Styles', 'holmes' )
			)
		);
		
		$mobile_header_row1 = holmes_mkdf_add_admin_row(
			array(
				'parent' => $mobile_header_group,
				'name'   => 'mobile_header_row1'
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'   => 'mobile_header_height',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Height', 'holmes' ),
				'parent' => $mobile_header_row1,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'   => 'mobile_header_background_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Background Color', 'holmes' ),
				'parent' => $mobile_header_row1
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'   => 'mobile_header_border_bottom_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Border Bottom Color', 'holmes' ),
				'parent' => $mobile_header_row1
			)
		);
		
		$mobile_menu_group = holmes_mkdf_add_admin_group(
			array(
				'parent' => $panel_mobile_header,
				'name'   => 'mobile_menu_group',
				'title'  => esc_html__( 'Mobile Menu Styles', 'holmes' )
			)
		);
		
		$mobile_menu_row1 = holmes_mkdf_add_admin_row(
			array(
				'parent' => $mobile_menu_group,
				'name'   => 'mobile_menu_row1'
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'   => 'mobile_menu_background_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Background Color', 'holmes' ),
				'parent' => $mobile_menu_row1
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'   => 'mobile_menu_border_bottom_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Border Bottom Color', 'holmes' ),
				'parent' => $mobile_menu_row1
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'   => 'mobile_menu_separator_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Menu Item Separator Color', 'holmes' ),
				'parent' => $mobile_menu_row1
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'        => 'mobile_logo_height',
				'type'        => 'text',
				'label'       => esc_html__( 'Logo Height For Mobile Header', 'holmes' ),
				'description' => esc_html__( 'Define logo height for screen size smaller than 1024px', 'holmes' ),
				'parent'      => $panel_mobile_header,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'        => 'mobile_logo_height_phones',
				'type'        => 'text',
				'label'       => esc_html__( 'Logo Height For Mobile Devices', 'holmes' ),
				'description' => esc_html__( 'Define logo height for screen size smaller than 480px', 'holmes' ),
				'parent'      => $panel_mobile_header,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		holmes_mkdf_add_admin_section_title(
			array(
				'parent' => $panel_mobile_header,
				'name'   => 'mobile_header_fonts_title',
				'title'  => esc_html__( 'Typography', 'holmes' )
			)
		);
		
		$first_level_group = holmes_mkdf_add_admin_group(
			array(
				'parent'      => $panel_mobile_header,
				'name'        => 'first_level_group',
				'title'       => esc_html__( '1st Level Menu', 'holmes' ),
				'description' => esc_html__( 'Define styles for 1st level in Mobile Menu Navigation', 'holmes' )
			)
		);
		
		$first_level_row1 = holmes_mkdf_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row1'
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'   => 'mobile_text_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Text Color', 'holmes' ),
				'parent' => $first_level_row1
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'   => 'mobile_text_hover_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Hover/Active Text Color', 'holmes' ),
				'parent' => $first_level_row1
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'   => 'mobile_text_google_fonts',
				'type'   => 'fontsimple',
				'label'  => esc_html__( 'Font Family', 'holmes' ),
				'parent' => $first_level_row1
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'   => 'mobile_text_font_size',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Font Size', 'holmes' ),
				'parent' => $first_level_row1,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		$first_level_row2 = holmes_mkdf_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row2'
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'   => 'mobile_text_line_height',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Line Height', 'holmes' ),
				'parent' => $first_level_row2,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'    => 'mobile_text_text_transform',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Text Transform', 'holmes' ),
				'parent'  => $first_level_row2,
				'options' => holmes_mkdf_get_text_transform_array()
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'    => 'mobile_text_font_style',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Font Style', 'holmes' ),
				'parent'  => $first_level_row2,
				'options' => holmes_mkdf_get_font_style_array()
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'    => 'mobile_text_font_weight',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Font Weight', 'holmes' ),
				'parent'  => $first_level_row2,
				'options' => holmes_mkdf_get_font_weight_array()
			)
		);
		
		$first_level_row3 = holmes_mkdf_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row3'
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'mobile_text_letter_spacing',
				'label'         => esc_html__( 'Letter Spacing', 'holmes' ),
				'default_value' => '',
				'parent'        => $first_level_row3,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$second_level_group = holmes_mkdf_add_admin_group(
			array(
				'parent'      => $panel_mobile_header,
				'name'        => 'second_level_group',
				'title'       => esc_html__( 'Dropdown Menu', 'holmes' ),
				'description' => esc_html__( 'Define styles for drop down menu items in Mobile Menu Navigation', 'holmes' )
			)
		);
		
		$second_level_row1 = holmes_mkdf_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row1'
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Text Color', 'holmes' ),
				'parent' => $second_level_row1
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_hover_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Hover/Active Text Color', 'holmes' ),
				'parent' => $second_level_row1
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_google_fonts',
				'type'   => 'fontsimple',
				'label'  => esc_html__( 'Font Family', 'holmes' ),
				'parent' => $second_level_row1
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_font_size',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Font Size', 'holmes' ),
				'parent' => $second_level_row1,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		$second_level_row2 = holmes_mkdf_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row2'
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_line_height',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Line Height', 'holmes' ),
				'parent' => $second_level_row2,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'    => 'mobile_dropdown_text_text_transform',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Text Transform', 'holmes' ),
				'parent'  => $second_level_row2,
				'options' => holmes_mkdf_get_text_transform_array()
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'    => 'mobile_dropdown_text_font_style',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Font Style', 'holmes' ),
				'parent'  => $second_level_row2,
				'options' => holmes_mkdf_get_font_style_array()
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'    => 'mobile_dropdown_text_font_weight',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Font Weight', 'holmes' ),
				'parent'  => $second_level_row2,
				'options' => holmes_mkdf_get_font_weight_array()
			)
		);
		
		$second_level_row3 = holmes_mkdf_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row3'
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'mobile_dropdown_text_letter_spacing',
				'label'         => esc_html__( 'Letter Spacing', 'holmes' ),
				'default_value' => '',
				'parent'        => $second_level_row3,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		holmes_mkdf_add_admin_section_title(
			array(
				'name'   => 'mobile_opener_panel',
				'parent' => $panel_mobile_header,
				'title'  => esc_html__( 'Mobile Menu Opener', 'holmes' )
			)
		);

		//holmes_mkdf_add_admin_field(
		//	array(
		//		'name'        => 'mobile_menu_title',
		//		'type'        => 'text',
		//		'label'       => esc_html__( 'Mobile Navigation Title', 'holmes' ),
		//		'description' => esc_html__( 'Enter title for mobile menu navigation', 'holmes' ),
		//		'parent'      => $panel_mobile_header,
		//		'args'        => array(
		//			'col_width' => 3
		//		)
		//	)
		//);

		holmes_mkdf_add_admin_field(
			array(
				'parent'        => $panel_mobile_header,
				'type'          => 'select',
				'name'          => 'mobile_icon_source',
				'default_value' => 'icon_pack',
				'label'         => esc_html__( 'Select Mobile Navigation Icon Source', 'holmes' ),
				'description'   => esc_html__( 'Choose whether you would like to use icons from an icon pack or SVG icons', 'holmes' ),
				'options'       => holmes_mkdf_get_icon_sources_array()
			)
		);

		$mobile_icon_pack_container = holmes_mkdf_add_admin_container(
			array(
				'parent'          => $panel_mobile_header,
				'name'            => 'mobile_icon_pack_container',
				'dependency' => array(
					'show' => array(
						'mobile_icon_source' => 'icon_pack'
					)
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent'        => $mobile_icon_pack_container,
				'type'          => 'select',
				'name'          => 'mobile_icon_pack',
				'default_value' => 'font_elegant',
				'label'         => esc_html__( 'Mobile Navigation Icon Pack', 'holmes' ),
				'description'   => esc_html__( 'Choose icon pack for mobile navigation icon', 'holmes' ),
				'options'       => holmes_mkdf_icon_collections()->getIconCollectionsExclude( array( 'linea_icons', 'dripicons', 'simple_line_icons' ) )
			)
		);

		$mobile_icon_svg_path_container = holmes_mkdf_add_admin_container(
			array(
				'parent'          => $panel_mobile_header,
				'name'            => 'mobile_icon_svg_path_container',
				'dependency' => array(
					'show' => array(
						'mobile_icon_source' => 'svg_path'
					)
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent'      => $mobile_icon_svg_path_container,
				'type'        => 'textarea',
				'name'        => 'mobile_icon_svg_path',
				'label'       => esc_html__( 'Mobile Navigation Icon SVG Path', 'holmes' ),
				'description' => esc_html__( 'Enter your mobile navigation icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'holmes' ),
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'   => 'mobile_icon_color',
				'type'   => 'color',
				'label'  => esc_html__( 'Mobile Navigation Icon Color', 'holmes' ),
				'parent' => $panel_mobile_header
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'   => 'mobile_icon_hover_color',
				'type'   => 'color',
				'label'  => esc_html__( 'Mobile Navigation Icon Hover Color', 'holmes' ),
				'parent' => $panel_mobile_header
			)
		);
	}
	
	add_action( 'holmes_mkdf_options_map', 'holmes_mkdf_mobile_header_options_map', holmes_mkdf_set_options_map_position( 'mobile-header' ) );
}
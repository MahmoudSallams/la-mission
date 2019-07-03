<?php

if ( ! function_exists( 'holmes_mkdf_get_hide_dep_for_header_menu_area_options' ) ) {
	function holmes_mkdf_get_hide_dep_for_header_menu_area_options() {
		$hide_dep_options = apply_filters( 'holmes_mkdf_header_menu_area_hide_global_option', $hide_dep_options = array() );

		return $hide_dep_options;
	}
}

if ( ! function_exists( 'holmes_mkdf_get_hide_dep_for_menu_toggle_options' ) ) {
	function holmes_mkdf_get_hide_dep_for_menu_toggle_options() {
		$hide_dep_options_2 = apply_filters( 'holmes_mkdf_menu_toggle_hide_global_option', $hide_dep_options_2 = array() );

		return $hide_dep_options_2;
	}
}

if ( ! function_exists( 'holmes_mkdf_header_menu_area_options_map' ) ) {
	function holmes_mkdf_header_menu_area_options_map( $panel_header ) {
		$hide_dep_options   = holmes_mkdf_get_hide_dep_for_header_menu_area_options();
		$hide_dep_options_2 = holmes_mkdf_get_hide_dep_for_menu_toggle_options();

		$menu_area_container = holmes_mkdf_add_admin_container_no_style(
			array(
				'parent'     => $panel_header,
				'name'       => 'menu_area_container',
				'dependency' => array(
					'hide' => array(
						'header_options' => $hide_dep_options
					)
				),
			)
		);

		holmes_mkdf_add_admin_section_title(
			array(
				'parent' => $menu_area_container,
				'name'   => 'menu_area_style',
				'title'  => esc_html__( 'Menu Area Style', 'holmes' )
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent'        => $menu_area_container,
				'type'          => 'yesno',
				'name'          => 'menu_area_in_grid',
				'default_value' => 'no',
				'label'         => esc_html__( 'Menu Area In Grid', 'holmes' ),
				'description'   => esc_html__( 'Set menu area content to be in grid', 'holmes' ),
			)
		);

		$menu_area_in_grid_container = holmes_mkdf_add_admin_container(
			array(
				'parent'     => $menu_area_container,
				'name'       => 'menu_area_in_grid_container',
				'dependency' => array(
					'hide' => array(
						'menu_area_in_grid' => 'no'
					)
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_container,
				'type'          => 'color',
				'name'          => 'menu_area_grid_background_color',
				'default_value' => '',
				'label'         => esc_html__( 'Grid Background Color', 'holmes' ),
				'description'   => esc_html__( 'Set grid background color for menu area', 'holmes' ),
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_container,
				'type'          => 'text',
				'name'          => 'menu_area_grid_background_transparency',
				'default_value' => '',
				'label'         => esc_html__( 'Grid Background Transparency', 'holmes' ),
				'description'   => esc_html__( 'Set grid background transparency for menu area', 'holmes' ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_container,
				'type'          => 'yesno',
				'name'          => 'menu_area_in_grid_shadow',
				'default_value' => 'no',
				'label'         => esc_html__( 'Grid Area Shadow', 'holmes' ),
				'description'   => esc_html__( 'Set shadow on grid area', 'holmes' )
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_container,
				'type'          => 'yesno',
				'name'          => 'menu_area_in_grid_border',
				'default_value' => 'no',
				'label'         => esc_html__( 'Grid Area Border', 'holmes' ),
				'description'   => esc_html__( 'Set border on grid area', 'holmes' )
			)
		);

		$menu_area_in_grid_border_container = holmes_mkdf_add_admin_container(
			array(
				'parent'     => $menu_area_in_grid_container,
				'name'       => 'menu_area_in_grid_border_container',
				'dependency' => array(
					'hide' => array(
						'menu_area_in_grid_border' => 'no'
					)
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_border_container,
				'type'          => 'color',
				'name'          => 'menu_area_in_grid_border_color',
				'default_value' => '',
				'label'         => esc_html__( 'Border Color', 'holmes' ),
				'description'   => esc_html__( 'Set border color for menu area', 'holmes' ),
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent'        => $menu_area_container,
				'type'          => 'color',
				'name'          => 'menu_area_background_color',
				'default_value' => '',
				'label'         => esc_html__( 'Background Color', 'holmes' ),
				'description'   => esc_html__( 'Set background color for menu area', 'holmes' )
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent'        => $menu_area_container,
				'type'          => 'text',
				'name'          => 'menu_area_background_transparency',
				'default_value' => '',
				'label'         => esc_html__( 'Background Transparency', 'holmes' ),
				'description'   => esc_html__( 'Set background transparency for menu area', 'holmes' ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent'        => $menu_area_container,
				'type'          => 'yesno',
				'name'          => 'menu_area_shadow',
				'default_value' => 'no',
				'label'         => esc_html__( 'Menu Area Shadow', 'holmes' ),
				'description'   => esc_html__( 'Set shadow on menu area', 'holmes' ),
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'menu_area_border',
				'default_value' => 'no',
				'label'         => esc_html__( 'Menu Area Border', 'holmes' ),
				'description'   => esc_html__( 'Set border on menu area', 'holmes' ),
				'parent'        => $menu_area_container
			)
		);

		$menu_area_border_container = holmes_mkdf_add_admin_container(
			array(
				'parent'     => $menu_area_container,
				'name'       => 'menu_area_border_container',
				'dependency' => array(
					'hide' => array(
						'menu_area_border' => 'no'
					)
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'        => 'color',
				'name'        => 'menu_area_border_color',
				'label'       => esc_html__( 'Border Color', 'holmes' ),
				'description' => esc_html__( 'Set border color for menu area', 'holmes' ),
				'parent'      => $menu_area_border_container
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'        => 'text',
				'name'        => 'menu_area_height',
				'label'       => esc_html__( 'Height', 'holmes' ),
				'description' => esc_html__( 'Enter header height', 'holmes' ),
				'parent'      => $menu_area_container,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'   => 'text',
				'name'   => 'menu_area_side_padding',
				'label'  => esc_html__( 'Menu Area Side Padding', 'holmes' ),
				'parent' => $menu_area_container,
				'args'   => array(
					'col_width' => 2,
					'suffix'    => esc_html__( 'px or %', 'holmes' )
				)
			)
		);

		////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		$menu_toggle_panel = holmes_mkdf_add_admin_panel(
			array(
				'title'      => esc_html__( 'Menu Toggle', 'holmes' ),
				'name'       => 'panel_menu_toggle',
				'page'       => '_header_page',
				'dependency' => array(
					'hide' => array(
						'header_options' => $hide_dep_options_2
					)
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent'        => $menu_toggle_panel,
				'type'          => 'select',
				'name'          => 'fullscreen_menu_icon_source',
				'default_value' => 'icon_pack',
				'label'         => esc_html__( 'Select Menu Toggle Icon Source', 'holmes' ),
				'description'   => esc_html__( 'Choose whether you would like to use icons from an icon pack or SVG icons', 'holmes' ),
				'options'       => holmes_mkdf_get_icon_sources_array()
			)
		);

		$fullscreen_menu_icon_pack_container = holmes_mkdf_add_admin_container(
			array(
				'parent'     => $menu_toggle_panel,
				'name'       => 'fullscreen_menu_icon_pack_container',
				'dependency' => array(
					'show' => array(
						'fullscreen_menu_icon_source' => 'icon_pack'
					)
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent'        => $fullscreen_menu_icon_pack_container,
				'type'          => 'select',
				'name'          => 'fullscreen_menu_icon_pack',
				'default_value' => 'font_elegant',
				'label'         => esc_html__( 'Menu Toggle Icon Pack', 'holmes' ),
				'description'   => esc_html__( 'Choose icon pack for menu toggle icons', 'holmes' ),
				'options'       => holmes_mkdf_icon_collections()->getIconCollectionsExclude( array(
					'linea_icons',
					'dripicons',
					'simple_line_icons'
				) )
			)
		);

		$fullscreen_menu_icon_svg_path_container = holmes_mkdf_add_admin_container(
			array(
				'parent'     => $menu_toggle_panel,
				'name'       => 'fullscreen_menu_icon_svg_path_container',
				'dependency' => array(
					'show' => array(
						'fullscreen_menu_icon_source' => 'svg_path'
					)
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent'      => $fullscreen_menu_icon_svg_path_container,
				'type'        => 'textarea',
				'name'        => 'fullscreen_menu_icon_svg_path',
				'label'       => esc_html__( 'Menu Open Icon SVG Path', 'holmes' ),
				'description' => esc_html__( 'Enter your menu open icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'holmes' ),
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent'      => $fullscreen_menu_icon_svg_path_container,
				'type'        => 'textarea',
				'name'        => 'fullscreen_menu_close_icon_svg_path',
				'label'       => esc_html__( 'Menu Close Icon SVG Path', 'holmes' ),
				'description' => esc_html__( 'Enter your menu close icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'holmes' ),
			)
		);

		$icon_style_group = holmes_mkdf_add_admin_group(
			array(
				'parent'      => $menu_toggle_panel,
				'name'        => 'fullscreen_menu_icon_style_group',
				'title'       => esc_html__( 'Menu Toggle Icon Style', 'holmes' ),
				'description' => esc_html__( 'Define styles for full screen menu icon', 'holmes' )
			)
		);

		$icon_colors_row1 = holmes_mkdf_add_admin_row(
			array(
				'parent' => $icon_style_group,
				'name'   => 'icon_colors_row1'
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent' => $icon_colors_row1,
				'type'   => 'colorsimple',
				'name'   => 'fullscreen_menu_icon_color',
				'label'  => esc_html__( 'Color', 'holmes' ),
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent' => $icon_colors_row1,
				'type'   => 'colorsimple',
				'name'   => 'fullscreen_menu_icon_hover_color',
				'label'  => esc_html__( 'Hover Color', 'holmes' ),
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent' => $icon_colors_row1,
				'type'   => 'colorsimple',
				'name'   => 'fullscreen_menu_icon_mobile_color',
				'label'  => esc_html__( 'Mobile Color', 'holmes' ),
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent' => $icon_colors_row1,
				'type'   => 'colorsimple',
				'name'   => 'fullscreen_menu_icon_mobile_hover_color',
				'label'  => esc_html__( 'Mobile Hover Color', 'holmes' ),
			)
		);

		////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		do_action( 'holmes_mkdf_header_menu_area_additional_options', $panel_header );
	}

	add_action( 'holmes_mkdf_header_menu_area_options_map', 'holmes_mkdf_header_menu_area_options_map', 10, 1 );
}
<?php

if ( ! function_exists( 'holmes_mkdf_sidearea_options_map' ) ) {
	function holmes_mkdf_sidearea_options_map() {

		holmes_mkdf_add_admin_page(
			array(
				'slug'  => '_side_area_page',
				'title' => esc_html__( 'Side Area', 'holmes' ),
				'icon'  => 'fa fa-indent'
			)
		);

		$side_area_panel = holmes_mkdf_add_admin_panel(
			array(
				'title' => esc_html__( 'Side Area', 'holmes' ),
				'name'  => 'side_area',
				'page'  => '_side_area_page'
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent'        => $side_area_panel,
				'type'          => 'select',
				'name'          => 'side_area_type',
				'default_value' => 'side-menu-slide-from-right',
				'label'         => esc_html__( 'Side Area Type', 'holmes' ),
				'description'   => esc_html__( 'Choose a type of Side Area', 'holmes' ),
				'options'       => array(
					'side-menu-slide-from-right'       => esc_html__( 'Slide from Right Over Content', 'holmes' ),
					//'side-menu-slide-with-content'     => esc_html__( 'Slide from Right With Content', 'holmes' ),
					//'side-area-uncovered-from-content' => esc_html__( 'Side Area Uncovered from Content', 'holmes' ),
				),
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent'        => $side_area_panel,
				'type'          => 'text',
				'name'          => 'side_area_width',
				'default_value' => '',
				'label'         => esc_html__( 'Side Area Width', 'holmes' ),
				'description'   => esc_html__( 'Enter a width for Side Area (px or %). Default width: 50%.', 'holmes' ),
				'args'          => array(
					'col_width' => 3,
				)
			)
		);

		$side_area_width_container = holmes_mkdf_add_admin_container(
			array(
				'parent'     => $side_area_panel,
				'name'       => 'side_area_width_container',
				'dependency' => array(
					'show' => array(
						'side_area_type' => 'side-menu-slide-from-right',
					)
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent'        => $side_area_width_container,
				'type'          => 'color',
				'name'          => 'side_area_content_overlay_color',
				'default_value' => '',
				'label'         => esc_html__( 'Content Overlay Background Color', 'holmes' ),
				'description'   => esc_html__( 'Choose a background color for a content overlay', 'holmes' ),
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent'        => $side_area_width_container,
				'type'          => 'text',
				'name'          => 'side_area_content_overlay_opacity',
				'default_value' => '',
				'label'         => esc_html__( 'Content Overlay Background Transparency', 'holmes' ),
				'description'   => esc_html__( 'Choose a transparency for the content overlay background color (0 = fully transparent, 1 = opaque)', 'holmes' ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent'        => $side_area_panel,
				'type'          => 'select',
				'name'          => 'side_area_icon_source',
				'default_value' => 'icon_pack',
				'label'         => esc_html__( 'Select Side Area Icon Source', 'holmes' ),
				'description'   => esc_html__( 'Choose whether you would like to use icons from an icon pack or SVG icons', 'holmes' ),
				'options'       => holmes_mkdf_get_icon_sources_array()
			)
		);

		$side_area_icon_pack_container = holmes_mkdf_add_admin_container(
			array(
				'parent'     => $side_area_panel,
				'name'       => 'side_area_icon_pack_container',
				'dependency' => array(
					'show' => array(
						'side_area_icon_source' => 'icon_pack'
					)
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent'        => $side_area_icon_pack_container,
				'type'          => 'select',
				'name'          => 'side_area_icon_pack',
				'default_value' => 'font_elegant',
				'label'         => esc_html__( 'Side Area Icon Pack', 'holmes' ),
				'description'   => esc_html__( 'Choose icon pack for Side Area icon', 'holmes' ),
				'options'       => holmes_mkdf_icon_collections()->getIconCollectionsExclude( array(
					'linea_icons',
					'dripicons',
					'simple_line_icons'
				) )
			)
		);

		$side_area_svg_icons_container = holmes_mkdf_add_admin_container(
			array(
				'parent'     => $side_area_panel,
				'name'       => 'side_area_svg_icons_container',
				'dependency' => array(
					'show' => array(
						'side_area_icon_source' => 'svg_path'
					)
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent'      => $side_area_svg_icons_container,
				'type'        => 'textarea',
				'name'        => 'side_area_icon_svg_path',
				'label'       => esc_html__( 'Side Area Icon SVG Path', 'holmes' ),
				'description' => esc_html__( 'Enter your Side Area icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'holmes' ),
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent'      => $side_area_svg_icons_container,
				'type'        => 'textarea',
				'name'        => 'side_area_close_icon_svg_path',
				'label'       => esc_html__( 'Side Area Close Icon SVG Path', 'holmes' ),
				'description' => esc_html__( 'Enter your Side Area close icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'holmes' ),
			)
		);

		$side_area_icon_style_group = holmes_mkdf_add_admin_group(
			array(
				'parent'      => $side_area_panel,
				'name'        => 'side_area_icon_style_group',
				'title'       => esc_html__( 'Side Area Icon Style', 'holmes' ),
				'description' => esc_html__( 'Define styles for Side Area icon', 'holmes' )
			)
		);

		$side_area_icon_style_row1 = holmes_mkdf_add_admin_row(
			array(
				'parent' => $side_area_icon_style_group,
				'name'   => 'side_area_icon_style_row1'
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row1,
				'type'   => 'colorsimple',
				'name'   => 'side_area_icon_color',
				'label'  => esc_html__( 'Color', 'holmes' )
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row1,
				'type'   => 'colorsimple',
				'name'   => 'side_area_icon_hover_color',
				'label'  => esc_html__( 'Hover Color', 'holmes' )
			)
		);

		$side_area_icon_style_row2 = holmes_mkdf_add_admin_row(
			array(
				'parent' => $side_area_icon_style_group,
				'name'   => 'side_area_icon_style_row2',
				'next'   => true
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row2,
				'type'   => 'colorsimple',
				'name'   => 'side_area_close_icon_color',
				'label'  => esc_html__( 'Close Icon Color', 'holmes' )
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row2,
				'type'   => 'colorsimple',
				'name'   => 'side_area_close_icon_hover_color',
				'label'  => esc_html__( 'Close Icon Hover Color', 'holmes' )
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent'      => $side_area_panel,
				'type'        => 'color',
				'name'        => 'side_area_background_color',
				'label'       => esc_html__( 'Background Color', 'holmes' ),
				'description' => esc_html__( 'Choose a background color for Side Area', 'holmes' )
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent'      => $side_area_panel,
				'type'        => 'image',
				'name'        => 'side_area_background_image',
				'label'       => esc_html__( 'Background Image', 'holmes' ),
				'description' => esc_html__( 'Choose a background image for Side Area', 'holmes' )
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent'      => $side_area_panel,
				'type'        => 'text',
				'name'        => 'side_area_padding',
				'label'       => esc_html__( 'Padding', 'holmes' ),
				'description' => esc_html__( 'Define padding for Side Area in format top right bottom left', 'holmes' ),
				'args'        => array(
					'col_width' => 3
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent'        => $side_area_panel,
				'type'          => 'selectblank',
				'name'          => 'side_area_aligment',
				'default_value' => '',
				'label'         => esc_html__( 'Text Alignment', 'holmes' ),
				'description'   => esc_html__( 'Choose text alignment for side area', 'holmes' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'holmes' ),
					'left'   => esc_html__( 'Left', 'holmes' ),
					'center' => esc_html__( 'Center', 'holmes' ),
					'right'  => esc_html__( 'Right', 'holmes' )
				)
			)
		);
	}

	add_action( 'holmes_mkdf_options_map', 'holmes_mkdf_sidearea_options_map', holmes_mkdf_set_options_map_position( 'sidearea' ) );
}
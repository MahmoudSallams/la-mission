<?php
//
//if ( ! function_exists( 'holmes_mkdf_get_hide_dep_for_header_logo_area_options' ) ) {
//	function holmes_mkdf_get_hide_dep_for_header_logo_area_options() {
//		$hide_dep_options = apply_filters( 'holmes_mkdf_header_logo_area_hide_global_option', $hide_dep_options = array() );
//
//		return $hide_dep_options;
//	}
//}
//
//if ( ! function_exists( 'holmes_mkdf_header_logo_area_options_map' ) ) {
//	function holmes_mkdf_header_logo_area_options_map( $panel_header ) {
//		$hide_dep_options = holmes_mkdf_get_hide_dep_for_header_logo_area_options();
//
//		$logo_area_container = holmes_mkdf_add_admin_container_no_style(
//			array(
//				'parent'          => $panel_header,
//				'name'            => 'logo_area_container',
//				'dependency' => array(
//					'hide' => array(
//						'header_options'  => $hide_dep_options
//					)
//				)
//			)
//		);
//
//		holmes_mkdf_add_admin_section_title(
//			array(
//				'parent' => $logo_area_container,
//				'name'   => 'logo_menu_area_title',
//				'title'  => esc_html__( 'Logo Area', 'holmes' )
//			)
//		);
//
//		holmes_mkdf_add_admin_field(
//			array(
//				'parent'        => $logo_area_container,
//				'type'          => 'yesno',
//				'name'          => 'logo_area_in_grid',
//				'default_value' => 'no',
//				'label'         => esc_html__( 'Logo Area In Grid', 'holmes' ),
//				'description'   => esc_html__( 'Set menu area content to be in grid', 'holmes' )
//			)
//		);
//
//		$logo_area_in_grid_container = holmes_mkdf_add_admin_container(
//			array(
//				'parent'     => $logo_area_container,
//                'name'       => 'logo_area_in_grid_container',
//				'dependency' => array(
//					'hide' => array(
//						'logo_area_in_grid' => 'no'
//					)
//				)
//			)
//		);
//
//		holmes_mkdf_add_admin_field(
//			array(
//				'parent'        => $logo_area_in_grid_container,
//				'type'          => 'color',
//				'name'          => 'logo_area_grid_background_color',
//				'default_value' => '',
//				'label'         => esc_html__( 'Grid Background Color', 'holmes' ),
//				'description'   => esc_html__( 'Set grid background color for logo area', 'holmes' ),
//			)
//		);
//
//		holmes_mkdf_add_admin_field(
//			array(
//				'parent'        => $logo_area_in_grid_container,
//				'type'          => 'text',
//				'name'          => 'logo_area_grid_background_transparency',
//				'default_value' => '',
//				'label'         => esc_html__( 'Grid Background Transparency', 'holmes' ),
//				'description'   => esc_html__( 'Set grid background transparency', 'holmes' ),
//				'args'          => array(
//					'col_width' => 3
//				)
//			)
//		);
//
//		holmes_mkdf_add_admin_field(
//			array(
//				'parent'        => $logo_area_in_grid_container,
//				'type'          => 'yesno',
//				'name'          => 'logo_area_in_grid_border',
//				'default_value' => 'no',
//				'label'         => esc_html__( 'Grid Area Border', 'holmes' ),
//				'description'   => esc_html__( 'Set border on grid area', 'holmes' )
//			)
//		);
//
//		$logo_area_in_grid_border_container = holmes_mkdf_add_admin_container(
//			array(
//				'parent'          => $logo_area_in_grid_container,
//				'name'            => 'logo_area_in_grid_border_container',
//				'dependency' => array(
//					'hide' => array(
//						'logo_area_in_grid_border'  => 'no'
//					)
//				)
//			)
//		);
//
//		holmes_mkdf_add_admin_field(
//			array(
//				'parent'      => $logo_area_in_grid_border_container,
//				'type'        => 'color',
//				'name'        => 'logo_area_in_grid_border_color',
//				'label'       => esc_html__( 'Border Color', 'holmes' ),
//				'description' => esc_html__( 'Set border color for grid area', 'holmes' ),
//			)
//		);
//
//		holmes_mkdf_add_admin_field(
//			array(
//				'parent'      => $logo_area_container,
//				'type'        => 'color',
//				'name'        => 'logo_area_background_color',
//				'label'       => esc_html__( 'Background Color', 'holmes' ),
//				'description' => esc_html__( 'Set background color for logo area', 'holmes' )
//			)
//		);
//
//		holmes_mkdf_add_admin_field(
//			array(
//				'parent'        => $logo_area_container,
//				'type'          => 'text',
//				'name'          => 'logo_area_background_transparency',
//				'default_value' => '',
//				'label'         => esc_html__( 'Background Transparency', 'holmes' ),
//				'description'   => esc_html__( 'Set background transparency for logo area', 'holmes' ),
//				'args'          => array(
//					'col_width' => 3
//				)
//			)
//		);
//
//		holmes_mkdf_add_admin_field(
//			array(
//				'parent'        => $logo_area_container,
//				'type'          => 'yesno',
//				'name'          => 'logo_area_border',
//				'default_value' => 'no',
//				'label'         => esc_html__( 'Logo Area Border', 'holmes' ),
//				'description'   => esc_html__( 'Set border on logo area', 'holmes' )
//			)
//		);
//
//		$logo_area_border_container = holmes_mkdf_add_admin_container(
//			array(
//				'parent'          => $logo_area_container,
//				'name'            => 'logo_area_border_container',
//				'dependency' => array(
//					'hide' => array(
//						'logo_area_border'  => 'no'
//					)
//				)
//			)
//		);
//
//		holmes_mkdf_add_admin_field(
//			array(
//				'type'          => 'color',
//				'name'          => 'logo_area_border_color',
//				'label'         => esc_html__( 'Border Color', 'holmes' ),
//				'description'   => esc_html__( 'Set border color for logo area', 'holmes' ),
//				'parent'        => $logo_area_border_container
//			)
//		);
//
//		holmes_mkdf_add_admin_field(
//			array(
//				'type'          => 'text',
//				'name'          => 'logo_area_height',
//				'label'         => esc_html__( 'Height', 'holmes' ),
//				'description'   => esc_html__( 'Enter logo area height (default is 90px)', 'holmes' ),
//				'parent'        => $logo_area_container,
//				'args'          => array(
//					'col_width' => 3,
//					'suffix'    => 'px'
//				)
//			)
//		);
//
//		do_action( 'holmes_mkdf_header_logo_area_additional_options', $logo_area_container );
//	}
//
//	add_action( 'holmes_mkdf_header_logo_area_options_map', 'holmes_mkdf_header_logo_area_options_map', 10, 1 );
//}
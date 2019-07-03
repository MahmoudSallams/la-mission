<?php

if ( ! function_exists( 'holmes_mkdf_content_bottom_options_map' ) ) {
	function holmes_mkdf_content_bottom_options_map() {
		
		$panel_content_bottom = holmes_mkdf_add_admin_panel(
			array(
				'page'  => '_page_page',
				'name'  => 'panel_content_bottom',
				'title' => esc_html__( 'Content Bottom Area Style', 'holmes' )
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'enable_content_bottom_area',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Content Bottom Area', 'holmes' ),
				'description'   => esc_html__( 'This option will enable Content Bottom area on pages', 'holmes' ),
				'parent'        => $panel_content_bottom
			)
		);
		
		$enable_content_bottom_area_container = holmes_mkdf_add_admin_container(
			array(
				'parent'          => $panel_content_bottom,
				'name'            => 'enable_content_bottom_area_container',
				'dependency' => array(
					'show' => array(
						'enable_content_bottom_area'  => 'yes'
					)
				)
			)
		);
		
		$holmes_custom_sidebars = holmes_mkdf_get_custom_sidebars();
		
		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'selectblank',
				'name'          => 'content_bottom_sidebar_custom_display',
				'default_value' => '',
				'label'         => esc_html__( 'Widget Area to Display', 'holmes' ),
				'description'   => esc_html__( 'Choose a Content Bottom widget area to display', 'holmes' ),
				'options'       => $holmes_custom_sidebars,
				'parent'        => $enable_content_bottom_area_container
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'content_bottom_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Display in Grid', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will place Content Bottom in grid', 'holmes' ),
				'parent'        => $enable_content_bottom_area_container
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'type'        => 'color',
				'name'        => 'content_bottom_background_color',
				'label'       => esc_html__( 'Background Color', 'holmes' ),
				'description' => esc_html__( 'Choose a background color for Content Bottom area', 'holmes' ),
				'parent'      => $enable_content_bottom_area_container
			)
		);
	}
	
	add_action( 'holmes_mkdf_additional_page_options_map', 'holmes_mkdf_content_bottom_options_map' );
}
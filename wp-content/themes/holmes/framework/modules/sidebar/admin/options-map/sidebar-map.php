<?php

if ( ! function_exists( 'holmes_mkdf_sidebar_options_map' ) ) {
	function holmes_mkdf_sidebar_options_map() {
		
		holmes_mkdf_add_admin_page(
			array(
				'slug'  => '_sidebar_page',
				'title' => esc_html__( 'Sidebar Area', 'holmes' ),
				'icon'  => 'fa fa-indent'
			)
		);
		
		$sidebar_panel = holmes_mkdf_add_admin_panel(
			array(
				'title' => esc_html__( 'Sidebar Area', 'holmes' ),
				'name'  => 'sidebar',
				'page'  => '_sidebar_page'
			)
		);
		
		holmes_mkdf_add_admin_field( array(
			'name'          => 'sidebar_layout',
			'type'          => 'select',
			'label'         => esc_html__( 'Sidebar Layout', 'holmes' ),
			'description'   => esc_html__( 'Choose a sidebar layout for pages', 'holmes' ),
			'parent'        => $sidebar_panel,
			'default_value' => 'no-sidebar',
            'options'       => holmes_mkdf_get_custom_sidebars_options()
		) );
		
		$holmes_custom_sidebars = holmes_mkdf_get_custom_sidebars();
		if ( count( $holmes_custom_sidebars ) > 0 ) {
			holmes_mkdf_add_admin_field( array(
				'name'        => 'custom_sidebar_area',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'holmes' ),
				'description' => esc_html__( 'Choose a sidebar to display on pages. Default sidebar is "Sidebar"', 'holmes' ),
				'parent'      => $sidebar_panel,
				'options'     => $holmes_custom_sidebars,
				'args'        => array(
					'select2' => true
				)
			) );
		}
	}
	
	add_action( 'holmes_mkdf_options_map', 'holmes_mkdf_sidebar_options_map', holmes_mkdf_set_options_map_position( 'sidebar' ) );
}
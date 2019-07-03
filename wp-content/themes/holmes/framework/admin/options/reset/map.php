<?php

if ( ! function_exists( 'holmes_mkdf_reset_options_map' ) ) {
	/**
	 * Reset options panel
	 */
	function holmes_mkdf_reset_options_map() {
		
		holmes_mkdf_add_admin_page(
			array(
				'slug'  => '_reset_page',
				'title' => esc_html__( 'Reset', 'holmes' ),
				'icon'  => 'fa fa-retweet'
			)
		);
		
		$panel_reset = holmes_mkdf_add_admin_panel(
			array(
				'page'  => '_reset_page',
				'name'  => 'panel_reset',
				'title' => esc_html__( 'Reset', 'holmes' )
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'reset_to_defaults',
				'default_value' => 'no',
				'label'         => esc_html__( 'Reset to Defaults', 'holmes' ),
				'description'   => esc_html__( 'This option will reset all Select Options values to defaults', 'holmes' ),
				'parent'        => $panel_reset
			)
		);
	}
	
	add_action( 'holmes_mkdf_options_map', 'holmes_mkdf_reset_options_map', holmes_mkdf_set_options_map_position( 'reset' ) );
}
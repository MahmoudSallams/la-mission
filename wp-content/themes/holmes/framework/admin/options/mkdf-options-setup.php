<?php

if ( ! function_exists( 'holmes_mkdf_admin_map_init' ) ) {
	function holmes_mkdf_admin_map_init() {
		do_action( 'holmes_mkdf_before_options_map' );
		
		foreach ( glob( MIKADO_FRAMEWORK_ROOT_DIR . '/admin/options/*/*.php' ) as $module_load ) {
			include_once $module_load;
		}
		
		do_action( 'holmes_mkdf_options_map' );
		
		do_action( 'holmes_mkdf_after_options_map' );
	}
	
	add_action( 'after_setup_theme', 'holmes_mkdf_admin_map_init', 1 );
}
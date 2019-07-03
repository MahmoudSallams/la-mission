<?php

if ( ! function_exists( 'holmes_mkdf_include_blog_shortcodes' ) ) {
	function holmes_mkdf_include_blog_shortcodes() {
		foreach ( glob( MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/blog/shortcodes/*/load.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
	}
	
	if ( holmes_mkdf_core_plugin_installed() ) {
		add_action( 'holmes_core_action_include_shortcodes_file', 'holmes_mkdf_include_blog_shortcodes' );
	}
}

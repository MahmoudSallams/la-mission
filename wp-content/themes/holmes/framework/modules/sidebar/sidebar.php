<?php

if ( ! function_exists( 'holmes_mkdf_register_sidebars' ) ) {
	/**
	 * Function that registers theme's sidebars
	 */
	function holmes_mkdf_register_sidebars() {

		register_sidebar(
			array(
				'id'            => 'sidebar',
				'name'          => esc_html__( 'Sidebar', 'holmes' ),
				'description'   => esc_html__( 'Default Sidebar area. In order to display this area you need to enable it through global theme options or on page meta box options.', 'holmes' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="mkdf-widget-title-holder"><div class="mkdf-widget-bullet"><div class="mkdf-widget-bullet__number"></div><div class="mkdf-widget-bullet__line"></div></div><h5 class="mkdf-widget-title">',
				'after_title'   => '</h5></div>'
			)
		);
	}

	add_action( 'widgets_init', 'holmes_mkdf_register_sidebars', 1 );
}

if ( ! function_exists( 'holmes_mkdf_add_support_custom_sidebar' ) ) {
	/**
	 * Function that adds theme support for custom sidebars. It also creates HolmesMkdfSidebar object
	 */
	function holmes_mkdf_add_support_custom_sidebar() {
		add_theme_support( 'HolmesMkdfSidebar' );

		if ( get_theme_support( 'HolmesMkdfSidebar' ) ) {
			new HolmesMkdfSidebar();
		}
	}

	add_action( 'after_setup_theme', 'holmes_mkdf_add_support_custom_sidebar' );
}
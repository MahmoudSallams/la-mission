<?php

if ( ! function_exists( 'holmes_mkdf_register_side_area_sidebar' ) ) {
	/**
	 * Register side area sidebar
	 */
	function holmes_mkdf_register_side_area_sidebar() {
		register_sidebar(
			array(
				'id'            => 'sidearea',
				'name'          => esc_html__( 'Side Area', 'holmes' ),
				'description'   => esc_html__( 'Side Area', 'holmes' ),
				'before_widget' => '<div id="%1$s" class="widget mkdf-sidearea %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="mkdf-widget-title-holder"><h2 class="mkdf-widget-title">',
				'after_title'   => '</h2></div>'
			)
		);
	}

	add_action( 'widgets_init', 'holmes_mkdf_register_side_area_sidebar' );
}

if ( ! function_exists( 'holmes_mkdf_side_menu_body_class' ) ) {
	/**
	 * Function that adds body classes for different side menu styles
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function holmes_mkdf_side_menu_body_class( $classes ) {

		if ( is_active_widget( false, false, 'mkdf_side_area_opener' ) ) {

			if ( holmes_mkdf_options()->getOptionValue( 'side_area_type' ) ) {
				$classes[] = 'mkdf-' . holmes_mkdf_options()->getOptionValue( 'side_area_type' );
			}
		}

		return $classes;
	}

	add_filter( 'body_class', 'holmes_mkdf_side_menu_body_class' );
}

if ( ! function_exists( 'holmes_mkdf_get_side_area' ) ) {
	/**
	 * Loads side area HTML
	 */
	function holmes_mkdf_get_side_area() {

		if ( is_active_widget( false, false, 'mkdf_side_area_opener' ) ) {
			$parameters = array(
				'close_icon_classes' => holmes_mkdf_get_side_area_close_icon_class()
			);

			holmes_mkdf_get_module_template_part( 'templates/sidearea', 'sidearea', '', $parameters );
		}
	}

	add_action( 'holmes_mkdf_after_body_tag', 'holmes_mkdf_get_side_area', 10 );
}

if ( ! function_exists( 'holmes_mkdf_get_side_area_close_class' ) ) {
	/**
	 * Loads side area close icon class
	 */
	function holmes_mkdf_get_side_area_close_icon_class() {
		$classes = array(
			'mkdf-close-side-menu'
		);

		$classes[] = holmes_mkdf_get_icon_sources_class( 'side_area', 'mkdf-close-side-menu' );

		return $classes;
	}
}
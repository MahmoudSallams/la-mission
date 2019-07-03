<?php

if ( ! function_exists( 'holmes_core_enqueue_scripts_for_line_graph_shortcodes' ) ) {
    /**
     * Function that includes all necessary 3rd party scripts for this shortcode
     */
    function holmes_core_enqueue_scripts_for_line_graph_shortcodes() {
        wp_enqueue_script( 'ChartJs', HOLMES_CORE_SHORTCODES_URL_PATH . '/line-graph/assets/js/plugins/Chart.min.js', array( 'jquery' ), false, true );
    }

    add_action( 'holmes_mkdf_enqueue_third_party_scripts', 'holmes_core_enqueue_scripts_for_line_graph_shortcodes' );
}

if ( ! function_exists( 'holmes_core_add_line_graph_shortcodes' ) ) {
	function holmes_core_add_line_graph_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'HolmesCore\CPT\Shortcodes\LineGraph\LineGraph'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'holmes_core_filter_add_vc_shortcode', 'holmes_core_add_line_graph_shortcodes' );
}

if ( ! function_exists( 'holmes_core_set_line_graph_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for icon list item shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function holmes_core_set_line_graph_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-line-graph';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'holmes_core_filter_add_vc_shortcodes_custom_icon_class', 'holmes_core_set_line_graph_icon_class_name_for_vc_shortcodes' );
}
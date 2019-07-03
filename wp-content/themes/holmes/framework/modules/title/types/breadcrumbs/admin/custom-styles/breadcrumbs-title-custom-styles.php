<?php

if ( ! function_exists( 'holmes_mkdf_breadcrumbs_title_area_typography_style' ) ) {
	function holmes_mkdf_breadcrumbs_title_area_typography_style() {
		
		$item_styles = holmes_mkdf_get_typography_styles( 'page_breadcrumb' );
		
		$item_selector = array(
			'.mkdf-title-holder .mkdf-title-wrapper .mkdf-breadcrumbs'
		);
		
		echo holmes_mkdf_dynamic_css( $item_selector, $item_styles );
		
		
		$breadcrumb_hover_color = holmes_mkdf_options()->getOptionValue( 'page_breadcrumb_hovercolor' );
		
		$breadcrumb_hover_styles = array();
		if ( ! empty( $breadcrumb_hover_color ) ) {
			$breadcrumb_hover_styles['color'] = $breadcrumb_hover_color;
		}
		
		$breadcrumb_hover_selector = array(
			'.mkdf-title-holder .mkdf-title-wrapper .mkdf-breadcrumbs a:hover'
		);
		
		echo holmes_mkdf_dynamic_css( $breadcrumb_hover_selector, $breadcrumb_hover_styles );
	}
	
	add_action( 'holmes_mkdf_style_dynamic', 'holmes_mkdf_breadcrumbs_title_area_typography_style' );
}
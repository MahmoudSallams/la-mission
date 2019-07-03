<?php

if ( ! function_exists( 'holmes_mkdf_register_woocommerce_dropdown_cart_widget' ) ) {
	/**
	 * Function that register dropdown cart widget
	 */
	function holmes_mkdf_register_woocommerce_dropdown_cart_widget( $widgets ) {
		$widgets[] = 'HolmesMkdfWoocommerceDropdownCart';
		
		return $widgets;
	}
	
	add_filter( 'holmes_mkdf_register_widgets', 'holmes_mkdf_register_woocommerce_dropdown_cart_widget' );
}

if ( ! function_exists( 'holmes_mkdf_get_dropdown_cart_icon_class' ) ) {
	/**
	 * Returns dropdow cart icon class
	 */
	function holmes_mkdf_get_dropdown_cart_icon_class() {
		$classes = array(
			'mkdf-header-cart'
		);
		
		$classes[] = holmes_mkdf_get_icon_sources_class( 'dropdown_cart', 'mkdf-header-cart' );
		
		return $classes;
	}
}
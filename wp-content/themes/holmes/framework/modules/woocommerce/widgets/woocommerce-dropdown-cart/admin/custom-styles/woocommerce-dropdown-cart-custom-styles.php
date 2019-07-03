<?php

if ( ! function_exists( 'holmes_mkdf_dropdown_cart_icon_styles' ) ) {
	/**
	 * Generates styles for dropdown cart icon
	 */
	function holmes_mkdf_dropdown_cart_icon_styles() {
		$icon_color       = holmes_mkdf_options()->getOptionValue( 'dropdown_cart_icon_color' );
		$icon_hover_color = holmes_mkdf_options()->getOptionValue( 'dropdown_cart_hover_color' );

		if ( ! empty( $icon_color ) ) {
			echo holmes_mkdf_dynamic_css( '.mkdf-shopping-cart-holder .mkdf-header-cart', array( 'color' => $icon_color . '!important' ) );
		}

		if ( ! empty( $icon_hover_color ) ) {
			echo holmes_mkdf_dynamic_css( '.mkdf-shopping-cart-holder .mkdf-header-cart:hover', array( 'color' => $icon_hover_color . '!important' ) );
		}
	}

	add_action( 'holmes_mkdf_style_dynamic', 'holmes_mkdf_dropdown_cart_icon_styles' );
}
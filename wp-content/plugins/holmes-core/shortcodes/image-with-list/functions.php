<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Mkdf_Image_With_List extends WPBakeryShortCodesContainer {}
}

if ( ! function_exists( 'holmes_core_add_image_with_list_shortcodes' ) ) {
	function holmes_core_add_image_with_list_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'HolmesCore\CPT\Shortcodes\ImageWithList\ImageWithList',
			'HolmesCore\CPT\Shortcodes\ImageWithList\ImageWithListItem'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'holmes_core_filter_add_vc_shortcode', 'holmes_core_add_image_with_list_shortcodes' );
}

if ( ! function_exists( 'holmes_core_set_image_with_list_custom_style_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom css style for pricing table shortcode
	 */
	function holmes_core_set_image_with_list_custom_style_for_vc_shortcodes( $style ) {
		$current_style = '.wpb_content_element.wpb_mkdf_image_with_list_item > .wpb_element_wrapper { 
			background-color: #f4f4f4; 
		}';
		
		$style .= $current_style;
		
		return $style;
	}
	
	add_filter( 'holmes_core_filter_add_vc_shortcodes_custom_style', 'holmes_core_set_image_with_list_custom_style_for_vc_shortcodes' );
}

if ( ! function_exists( 'holmes_core_set_image_with_list_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for pricing table shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function holmes_core_set_image_with_list_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-image-with-list';
		$shortcodes_icon_class_array[] = '.icon-wpb-image-with-list-item';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'holmes_core_filter_add_vc_shortcodes_custom_icon_class', 'holmes_core_set_image_with_list_icon_class_name_for_vc_shortcodes' );
}
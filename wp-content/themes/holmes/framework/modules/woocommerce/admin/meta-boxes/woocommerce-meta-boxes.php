<?php

if ( ! function_exists( 'holmes_mkdf_map_woocommerce_meta' ) ) {
	function holmes_mkdf_map_woocommerce_meta() {
		
		$woocommerce_meta_box = holmes_mkdf_create_meta_box(
			array(
				'scope' => array( 'product' ),
				'title' => esc_html__( 'Product Meta', 'holmes' ),
				'name'  => 'woo_product_meta'
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_product_featured_image_size',
				'type'        => 'select',
				'label'       => esc_html__( 'Dimensions for Product List Shortcode', 'holmes' ),
				'description' => esc_html__( 'Choose image layout when it appears in Mikado Product List - Masonry layout shortcode', 'holmes' ),
				'options'     => array(
					''                   => esc_html__( 'Default', 'holmes' ),
					'small'              => esc_html__( 'Small', 'holmes' ),
					'large-width'        => esc_html__( 'Large Width', 'holmes' ),
					'large-height'       => esc_html__( 'Large Height', 'holmes' ),
					'large-width-height' => esc_html__( 'Large Width Height', 'holmes' )
				),
				'parent'      => $woocommerce_meta_box
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_show_title_area_woo_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'holmes' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'holmes' ),
				'options'       => holmes_mkdf_get_yes_no_select_array(),
				'parent'        => $woocommerce_meta_box
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_show_new_sign_woo_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show New Sign', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will show new sign mark on product', 'holmes' ),
				'parent'        => $woocommerce_meta_box
			)
		);
	}
	
	add_action( 'holmes_mkdf_meta_boxes_map', 'holmes_mkdf_map_woocommerce_meta', 99 );
}
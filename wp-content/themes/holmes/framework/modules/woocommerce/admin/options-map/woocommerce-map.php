<?php

if ( ! function_exists( 'holmes_mkdf_woocommerce_options_map' ) ) {

	/**
	 * Add Woocommerce options page
	 */
	function holmes_mkdf_woocommerce_options_map() {

		holmes_mkdf_add_admin_page(
			array(
				'slug'  => '_woocommerce_page',
				'title' => esc_html__( 'Woocommerce', 'holmes' ),
				'icon'  => 'fa fa-shopping-cart'
			)
		);

		/**
		 * Product List Settings
		 */
		$panel_product_list = holmes_mkdf_add_admin_panel(
			array(
				'page'  => '_woocommerce_page',
				'name'  => 'panel_product_list',
				'title' => esc_html__( 'Product List', 'holmes' )
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'        => 'woo_list_grid_space',
				'type'        => 'select',
				'label'       => esc_html__( 'Grid Layout Space', 'holmes' ),
				'description' => esc_html__( 'Choose a space between content layout and sidebar layout for main shop page', 'holmes' ),
				'options'     => holmes_mkdf_get_space_between_items_array( true ),
				'parent'      => $panel_product_list
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'mkdf_woo_product_list_columns',
				'label'         => esc_html__( 'Product List Columns', 'holmes' ),
				'default_value' => 'mkdf-woocommerce-columns-4',
				'description'   => esc_html__( 'Choose number of columns for main shop page', 'holmes' ),
				'options'       => array(
					'mkdf-woocommerce-columns-3' => esc_html__( '3 Columns', 'holmes' ),
					'mkdf-woocommerce-columns-4' => esc_html__( '4 Columns', 'holmes' )
				),
				'parent'        => $panel_product_list,
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'mkdf_woo_product_list_columns_space',
				'label'         => esc_html__( 'Space Between Items', 'holmes' ),
				'description'   => esc_html__( 'Select space between items for product listing and related products on single product', 'holmes' ),
				'default_value' => 'normal',
				'options'       => holmes_mkdf_get_space_between_items_array(),
				'parent'        => $panel_product_list,
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'mkdf_woo_product_list_info_position',
				'label'         => esc_html__( 'Product Info Position', 'holmes' ),
				'default_value' => 'info_on_image_hover',
				'description'   => esc_html__( 'Select product info position for product listing and related products on single product', 'holmes' ),
				'options'       => array(
					'info_on_image_hover' => esc_html__( 'Info On Image Hover', 'holmes' )
				),
				'parent'        => $panel_product_list,
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'        => 'text',
				'name'        => 'mkdf_woo_products_per_page',
				'label'       => esc_html__( 'Number of products per page', 'holmes' ),
				'description' => esc_html__( 'Set number of products on shop page', 'holmes' ),
				'parent'      => $panel_product_list,
				'args'        => array(
					'col_width' => 3
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'mkdf_products_list_title_tag',
				'label'         => esc_html__( 'Products Title Tag', 'holmes' ),
				'default_value' => 'h4',
				'options'       => holmes_mkdf_get_title_tag(),
				'parent'        => $panel_product_list,
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'woo_enable_percent_sign_value',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Percent Sign', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will show percent value mark instead of sale label on products', 'holmes' ),
				'parent'        => $panel_product_list
			)
		);

		/**
		 * Single Product Settings
		 */
		$panel_single_product = holmes_mkdf_add_admin_panel(
			array(
				'page'  => '_woocommerce_page',
				'name'  => 'panel_single_product',
				'title' => esc_html__( 'Single Product', 'holmes' )
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_woo',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single post pages', 'holmes' ),
				'parent'        => $panel_single_product,
				'options'       => holmes_mkdf_get_yes_no_select_array(),
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'mkdf_single_product_title_tag',
				'default_value' => 'h2',
				'label'         => esc_html__( 'Single Product Title Tag', 'holmes' ),
				'options'       => holmes_mkdf_get_title_tag(),
				'parent'        => $panel_single_product,
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_number_of_thumb_images',
				'default_value' => '4',
				'label'         => esc_html__( 'Number of Thumbnail Images per Row', 'holmes' ),
				'options'       => array(
					'4' => esc_html__( 'Four', 'holmes' ),
					'3' => esc_html__( 'Three', 'holmes' ),
					'2' => esc_html__( 'Two', 'holmes' )
				),
				'parent'        => $panel_single_product
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_set_thumb_images_position',
				'default_value' => 'on-left-side',
				'label'         => esc_html__( 'Set Thumbnail Images Position', 'holmes' ),
				'options'       => array(
					'on-left-side' => esc_html__( 'On The Left Side Of Featured Image', 'holmes' )
				),
				'parent'        => $panel_single_product
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_enable_single_product_zoom_image',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Zoom Maginfier', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will show magnifier image on featured image hover', 'holmes' ),
				'parent'        => $panel_single_product,
				'options'       => holmes_mkdf_get_yes_no_select_array( false ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_set_single_images_behavior',
				'default_value' => 'pretty-photo',
				'label'         => esc_html__( 'Set Images Behavior', 'holmes' ),
				'options'       => array(
					'pretty-photo' => esc_html__( 'Pretty Photo Lightbox', 'holmes' ),
					'photo-swipe'  => esc_html__( 'Photo Swipe Lightbox', 'holmes' )
				),
				'parent'        => $panel_single_product
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'mkdf_woo_related_products_columns',
				'label'         => esc_html__( 'Related Products Columns', 'holmes' ),
				'default_value' => 'mkdf-woocommerce-columns-4',
				'description'   => esc_html__( 'Choose number of columns for related products on single product page', 'holmes' ),
				'options'       => array(
					'mkdf-woocommerce-columns-3' => esc_html__( '3 Columns', 'holmes' ),
					'mkdf-woocommerce-columns-4' => esc_html__( '4 Columns', 'holmes' )
				),
				'parent'        => $panel_single_product,
			)
		);

		do_action( 'holmes_mkdf_woocommerce_additional_options_map' );
	}

	add_action( 'holmes_mkdf_options_map', 'holmes_mkdf_woocommerce_options_map', holmes_mkdf_set_options_map_position( 'woocommerce' ) );
}
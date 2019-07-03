<?php

if ( ! function_exists( 'holmes_core_map_portfolio_settings_meta' ) ) {
	function holmes_core_map_portfolio_settings_meta() {
		$meta_box = holmes_mkdf_create_meta_box( array(
			'scope' => 'portfolio-item',
			'title' => esc_html__( 'Portfolio Settings', 'holmes-core' ),
			'name'  => 'portfolio_settings_meta_box'
		) );
		
		holmes_mkdf_create_meta_box_field( array(
			'name'        => 'mkdf_portfolio_single_template_meta',
			'type'        => 'select',
			'label'       => esc_html__( 'Portfolio Type', 'holmes-core' ),
			'description' => esc_html__( 'Choose a default type for Single Project pages', 'holmes-core' ),
			'parent'      => $meta_box,
			'options'     => array(
				''                  => esc_html__( 'Default', 'holmes-core' ),
				'huge-images'       => esc_html__( 'Portfolio Full Width Images', 'holmes-core' ),
				'images'            => esc_html__( 'Portfolio Images', 'holmes-core' ),
				'small-images'      => esc_html__( 'Portfolio Small Images', 'holmes-core' ),
				'slider'            => esc_html__( 'Portfolio Slider', 'holmes-core' ),
				'small-slider'      => esc_html__( 'Portfolio Small Slider', 'holmes-core' ),
				'gallery'           => esc_html__( 'Portfolio Gallery', 'holmes-core' ),
				'small-gallery'     => esc_html__( 'Portfolio Small Gallery', 'holmes-core' ),
				'masonry'           => esc_html__( 'Portfolio Masonry', 'holmes-core' ),
				'small-masonry'     => esc_html__( 'Portfolio Small Masonry', 'holmes-core' ),
				'custom'            => esc_html__( 'Portfolio Custom', 'holmes-core' ),
				'full-width-custom' => esc_html__( 'Portfolio Full Width Custom', 'holmes-core' )
			)
		) );
		
		/***************** Gallery Layout *****************/
		
		$gallery_type_meta_container = holmes_mkdf_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'mkdf_gallery_type_meta_container',
				'dependency' => array(
					'show' => array(
						'mkdf_portfolio_single_template_meta'  => array(
							'gallery',
							'small-gallery'
						)
					)
				)
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_portfolio_single_gallery_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'holmes-core' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'holmes-core' ),
				'parent'        => $gallery_type_meta_container,
				'options'       => holmes_mkdf_get_number_of_columns_array( true, array( 'one', 'five', 'six' ) )
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_portfolio_single_gallery_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'holmes-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'holmes-core' ),
				'default_value' => '',
				'options'       => holmes_mkdf_get_space_between_items_array( true ),
				'parent'        => $gallery_type_meta_container
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$masonry_type_meta_container = holmes_mkdf_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'mkdf_masonry_type_meta_container',
				'dependency' => array(
					'show' => array(
						'mkdf_portfolio_single_template_meta'  => array(
							'masonry',
							'small-masonry'
						)
					)
				)
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_portfolio_single_masonry_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'holmes-core' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'holmes-core' ),
				'parent'        => $masonry_type_meta_container,
				'options'       => holmes_mkdf_get_number_of_columns_array( true, array( 'one', 'five', 'six' ) )
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_portfolio_single_masonry_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'holmes-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'holmes-core' ),
				'default_value' => '',
				'options'       => holmes_mkdf_get_space_between_items_array( true ),
				'parent'        => $masonry_type_meta_container
			)
		);
		
		/***************** Masonry Layout *****************/
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_show_title_area_portfolio_single_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'holmes-core' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single portfolio page', 'holmes-core' ),
				'parent'        => $meta_box,
				'options'       => holmes_mkdf_get_yes_no_select_array()
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'portfolio_info_top_padding',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Info Top Padding', 'holmes-core' ),
				'description' => esc_html__( 'Set top padding for portfolio info elements holder. This option works only for Portfolio Images, Slider, Gallery and Masonry portfolio types', 'holmes-core' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'portfolio_external_link',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio External Link', 'holmes-core' ),
				'description' => esc_html__( 'Enter URL to link from Portfolio List page', 'holmes-core' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_portfolio_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Featured Image', 'holmes-core' ),
				'description' => esc_html__( 'Choose an image for Portfolio Lists shortcode where Hover Type option is Switch Featured Images', 'holmes-core' ),
				'parent'      => $meta_box
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_portfolio_masonry_fixed_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Fixed Proportion', 'holmes-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is fixed', 'holmes-core' ),
				'default_value' => '',
				'parent'        => $meta_box,
				'options'       => array(
					''                   => esc_html__( 'Default', 'holmes-core' ),
					'small'              => esc_html__( 'Small', 'holmes-core' ),
					'large-width'        => esc_html__( 'Large Width', 'holmes-core' ),
					'large-height'       => esc_html__( 'Large Height', 'holmes-core' ),
					'large-width-height' => esc_html__( 'Large Width/Height', 'holmes-core' )
				)
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_portfolio_masonry_original_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Original Proportion', 'holmes-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is original', 'holmes-core' ),
				'default_value' => '',
				'parent'        => $meta_box,
				'options'       => array(
					''            => esc_html__( 'Default', 'holmes-core' ),
					'large-width' => esc_html__( 'Large Width', 'holmes-core' )
				)
			)
		);
		
		$all_pages = array();
		$pages     = get_pages();
		foreach ( $pages as $page ) {
			$all_pages[ $page->ID ] = $page->post_title;
		}
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'portfolio_single_back_to_link',
				'type'        => 'select',
				'label'       => esc_html__( '"Back To" Link', 'holmes-core' ),
				'description' => esc_html__( 'Choose "Back To" page to link from portfolio Single Project page', 'holmes-core' ),
				'parent'      => $meta_box,
				'options'     => $all_pages,
				'args'        => array(
					'select2' => true
				)
			)
		);
	}
	
	add_action( 'holmes_mkdf_meta_boxes_map', 'holmes_core_map_portfolio_settings_meta', 41 );
}
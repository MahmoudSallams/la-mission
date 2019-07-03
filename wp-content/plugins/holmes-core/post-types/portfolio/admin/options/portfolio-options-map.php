<?php

if ( ! function_exists( 'holmes_mkdf_portfolio_options_map' ) ) {
	function holmes_mkdf_portfolio_options_map() {
		
		holmes_mkdf_add_admin_page(
			array(
				'slug'  => '_portfolio',
				'title' => esc_html__( 'Portfolio', 'holmes-core' ),
				'icon'  => 'fa fa-camera-retro'
			)
		);
		
		$panel_archive = holmes_mkdf_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Archive', 'holmes-core' ),
				'name'  => 'panel_portfolio_archive',
				'page'  => '_portfolio'
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'        => 'portfolio_archive_number_of_items',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Items', 'holmes-core' ),
				'description' => esc_html__( 'Set number of items for your portfolio list on archive pages. Default value is 12', 'holmes-core' ),
				'parent'      => $panel_archive,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'portfolio_archive_number_of_columns',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'holmes-core' ),
				'default_value' => 'four',
				'description'   => esc_html__( 'Set number of columns for your portfolio list on archive pages. Default value is Four columns', 'holmes-core' ),
				'parent'        => $panel_archive,
				'options'       => holmes_mkdf_get_number_of_columns_array( false, array( 'one', 'six' ) )
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'portfolio_archive_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'holmes-core' ),
				'description'   => esc_html__( 'Set space size between portfolio items for your portfolio list on archive pages. Default value is normal', 'holmes-core' ),
				'default_value' => 'normal',
				'options'       => holmes_mkdf_get_space_between_items_array(),
				'parent'        => $panel_archive
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'portfolio_archive_image_size',
				'type'          => 'select',
				'label'         => esc_html__( 'Image Proportions', 'holmes-core' ),
				'default_value' => 'landscape',
				'description'   => esc_html__( 'Set image proportions for your portfolio list on archive pages. Default value is landscape', 'holmes-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'full'      => esc_html__( 'Original', 'holmes-core' ),
					'landscape' => esc_html__( 'Landscape', 'holmes-core' ),
					'portrait'  => esc_html__( 'Portrait', 'holmes-core' ),
					'square'    => esc_html__( 'Square', 'holmes-core' )
				)
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'portfolio_archive_item_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Item Style', 'holmes-core' ),
				'default_value' => 'standard-shader',
				'description'   => esc_html__( 'Set item style for your portfolio list on archive pages. Default value is Standard - Shader', 'holmes-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'standard-shader' => esc_html__( 'Standard - Shader', 'holmes-core' ),
					'gallery-overlay' => esc_html__( 'Gallery - Overlay', 'holmes-core' )
				)
			)
		);
		
		$panel = holmes_mkdf_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Single', 'holmes-core' ),
				'name'  => 'panel_portfolio_single',
				'page'  => '_portfolio'
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'portfolio_single_template',
				'type'          => 'select',
				'label'         => esc_html__( 'Portfolio Type', 'holmes-core' ),
				'default_value' => 'small-images',
				'description'   => esc_html__( 'Choose a default type for Single Project pages', 'holmes-core' ),
				'parent'        => $panel,
				'options'       => array(
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
			)
		);
		
		/***************** Gallery Layout *****************/
		
		$portfolio_gallery_container = holmes_mkdf_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_gallery_container',
				'dependency' => array(
					'show' => array(
						'portfolio_single_template'  => array(
							'gallery',
							'small-gallery'
						)
					)
				)
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'holmes-core' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'holmes-core' ),
				'parent'        => $portfolio_gallery_container,
				'options'       => holmes_mkdf_get_number_of_columns_array( false, array( 'one', 'five', 'six' ) )
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'holmes-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'holmes-core' ),
				'default_value' => 'normal',
				'options'       => holmes_mkdf_get_space_between_items_array(),
				'parent'        => $portfolio_gallery_container
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$portfolio_masonry_container = holmes_mkdf_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_masonry_container',
				'dependency' => array(
					'show' => array(
						'portfolio_single_template'  => array(
							'masonry',
							'small-masonry'
						)
					)
				)
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'holmes-core' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'holmes-core' ),
				'parent'        => $portfolio_masonry_container,
				'options'       => holmes_mkdf_get_number_of_columns_array( false, array( 'one', 'five', 'six' ) )
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'holmes-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'holmes-core' ),
				'default_value' => 'normal',
				'options'       => holmes_mkdf_get_space_between_items_array(),
				'parent'        => $portfolio_masonry_container
			)
		);
		
		/***************** Masonry Layout *****************/
		
		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_portfolio_single',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'holmes-core' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single projects', 'holmes-core' ),
				'parent'        => $panel,
				'options'       => array(
					''    => esc_html__( 'Default', 'holmes-core' ),
					'yes' => esc_html__( 'Yes', 'holmes-core' ),
					'no'  => esc_html__( 'No', 'holmes-core' )
				),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_images',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Images', 'holmes-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for projects with images', 'holmes-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_videos',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Videos', 'holmes-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for YouTube/Vimeo projects', 'holmes-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'portfolio_single_enable_categories',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Categories', 'holmes-core' ),
				'description'   => esc_html__( 'Enabling this option will enable category meta description on single projects', 'holmes-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_date',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Date', 'holmes-core' ),
				'description'   => esc_html__( 'Enabling this option will enable date meta on single projects', 'holmes-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'portfolio_single_sticky_sidebar',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Sticky Side Text', 'holmes-core' ),
				'description'   => esc_html__( 'Enabling this option will make side text sticky on Single Project pages. This option works only for Full Width Images, Small Images, Small Gallery and Small Masonry portfolio types', 'holmes-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'portfolio_single_comments',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Comments', 'holmes-core' ),
				'description'   => esc_html__( 'Enabling this option will show comments on your page', 'holmes-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_pagination',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Hide Pagination', 'holmes-core' ),
				'description'   => esc_html__( 'Enabling this option will turn off portfolio pagination functionality', 'holmes-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		$container_navigate_category = holmes_mkdf_add_admin_container(
			array(
				'name'            => 'navigate_same_category_container',
				'parent'          => $panel,
				'dependency' => array(
					'hide' => array(
						'portfolio_single_hide_pagination'  => array(
							'yes'
						)
					)
				)
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'portfolio_single_nav_same_category',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Pagination Through Same Category', 'holmes-core' ),
				'description'   => esc_html__( 'Enabling this option will make portfolio pagination sort through current category', 'holmes-core' ),
				'parent'        => $container_navigate_category,
				'default_value' => 'no'
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'        => 'portfolio_single_slug',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Single Slug', 'holmes-core' ),
				'description' => esc_html__( 'Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)', 'holmes-core' ),
				'parent'      => $panel,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'holmes_mkdf_options_map', 'holmes_mkdf_portfolio_options_map', holmes_mkdf_set_options_map_position( 'portfolio' ) );
}
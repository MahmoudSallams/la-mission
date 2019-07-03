<?php

foreach ( glob( MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/blog/admin/meta-boxes/*/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'holmes_mkdf_map_blog_meta' ) ) {
	function holmes_mkdf_map_blog_meta() {
		$mkdf_blog_categories = array();
		$categories           = get_categories();
		foreach ( $categories as $category ) {
			$mkdf_blog_categories[ $category->slug ] = $category->name;
		}
		
		$blog_meta_box = holmes_mkdf_create_meta_box(
			array(
				'scope' => array( 'page' ),
				'title' => esc_html__( 'Blog', 'holmes' ),
				'name'  => 'blog_meta'
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_blog_category_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Blog Category', 'holmes' ),
				'description' => esc_html__( 'Choose category of posts to display (leave empty to display all categories)', 'holmes' ),
				'parent'      => $blog_meta_box,
				'options'     => $mkdf_blog_categories
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_show_posts_per_page_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Posts', 'holmes' ),
				'description' => esc_html__( 'Enter the number of posts to display', 'holmes' ),
				'parent'      => $blog_meta_box,
				'options'     => $mkdf_blog_categories,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_blog_masonry_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Layout', 'holmes' ),
				'description' => esc_html__( 'Set masonry layout. Default is in grid.', 'holmes' ),
				'parent'      => $blog_meta_box,
				'options'     => array(
					''           => esc_html__( 'Default', 'holmes' ),
					'in-grid'    => esc_html__( 'In Grid', 'holmes' ),
					'full-width' => esc_html__( 'Full Width', 'holmes' )
				)
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_blog_masonry_number_of_columns_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Number of Columns', 'holmes' ),
				'description' => esc_html__( 'Set number of columns for your masonry blog lists', 'holmes' ),
				'parent'      => $blog_meta_box,
				'options'     => holmes_mkdf_get_number_of_columns_array( true, array( 'one', 'six' ) )
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_blog_masonry_space_between_items_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Space Between Items', 'holmes' ),
				'description' => esc_html__( 'Set space size between posts for your masonry blog lists', 'holmes' ),
				'options'     => holmes_mkdf_get_space_between_items_array( true ),
				'parent'      => $blog_meta_box
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_blog_list_featured_image_proportion_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Featured Image Proportion', 'holmes' ),
				'description'   => esc_html__( 'Choose type of proportions you want to use for featured images on masonry blog lists', 'holmes' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''         => esc_html__( 'Default', 'holmes' ),
					'fixed'    => esc_html__( 'Fixed', 'holmes' ),
					'original' => esc_html__( 'Original', 'holmes' )
				)
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_blog_pagination_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Pagination Type', 'holmes' ),
				'description'   => esc_html__( 'Choose a pagination layout for Blog Lists', 'holmes' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''                => esc_html__( 'Default', 'holmes' ),
					'standard'        => esc_html__( 'Standard', 'holmes' ),
					'load-more'       => esc_html__( 'Load More', 'holmes' ),
					'infinite-scroll' => esc_html__( 'Infinite Scroll', 'holmes' ),
					'no-pagination'   => esc_html__( 'No Pagination', 'holmes' )
				)
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'type'          => 'text',
				'name'          => 'mkdf_number_of_chars_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Number of Words in Excerpt', 'holmes' ),
				'description'   => esc_html__( 'Enter a number of words in excerpt (article summary). Default value is 40', 'holmes' ),
				'parent'        => $blog_meta_box,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'holmes_mkdf_meta_boxes_map', 'holmes_mkdf_map_blog_meta', 30 );
}
<?php

if ( ! function_exists( 'holmes_mkdf_get_blog_list_types_options' ) ) {
	function holmes_mkdf_get_blog_list_types_options() {
		$blog_list_type_options = apply_filters( 'holmes_mkdf_blog_list_type_global_option', $blog_list_type_options = array() );

		return $blog_list_type_options;
	}
}

if ( ! function_exists( 'holmes_mkdf_blog_options_map' ) ) {
	function holmes_mkdf_blog_options_map() {
		$blog_list_type_options = holmes_mkdf_get_blog_list_types_options();

		holmes_mkdf_add_admin_page(
			array(
				'slug'  => '_blog_page',
				'title' => esc_html__( 'Blog', 'holmes' ),
				'icon'  => 'fa fa-files-o'
			)
		);

		/**
		 * Blog Lists
		 */
		$panel_blog_lists = holmes_mkdf_add_admin_panel(
			array(
				'page'  => '_blog_page',
				'name'  => 'panel_blog_lists',
				'title' => esc_html__( 'Blog Lists', 'holmes' )
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'        => 'blog_list_grid_space',
				'type'        => 'select',
				'label'       => esc_html__( 'Grid Layout Space', 'holmes' ),
				'description' => esc_html__( 'Choose a space between content layout and sidebar layout for blog post lists. Default value is large', 'holmes' ),
				'options'     => holmes_mkdf_get_space_between_items_array( true ),
				'parent'      => $panel_blog_lists
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'blog_list_type',
				'type'          => 'select',
				'label'         => esc_html__( 'Blog Layout for Archive Pages', 'holmes' ),
				'description'   => esc_html__( 'Choose a default blog layout for archived blog post lists', 'holmes' ),
				'default_value' => 'standard',
				'parent'        => $panel_blog_lists,
				'options'       => $blog_list_type_options
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'archive_sidebar_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout for Archive Pages', 'holmes' ),
				'description'   => esc_html__( 'Choose a sidebar layout for archived blog post lists', 'holmes' ),
				'default_value' => '',
				'parent'        => $panel_blog_lists,
				'options'       => holmes_mkdf_get_custom_sidebars_options(),
			)
		);

		$holmes_custom_sidebars = holmes_mkdf_get_custom_sidebars();
		if ( count( $holmes_custom_sidebars ) > 0 ) {
			holmes_mkdf_add_admin_field(
				array(
					'name'        => 'archive_custom_sidebar_area',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Sidebar to Display for Archive Pages', 'holmes' ),
					'description' => esc_html__( 'Choose a sidebar to display on archived blog post lists. Default sidebar is "Sidebar Page"', 'holmes' ),
					'parent'      => $panel_blog_lists,
					'options'     => holmes_mkdf_get_custom_sidebars(),
					'args'        => array(
						'select2' => true
					)
				)
			);
		}

		//holmes_mkdf_add_admin_field(
		//	array(
		//		'name'          => 'blog_masonry_layout',
		//		'type'          => 'select',
		//		'label'         => esc_html__( 'Masonry - Layout', 'holmes' ),
		//		'default_value' => 'in-grid',
		//		'description'   => esc_html__( 'Set masonry layout. Default is in grid.', 'holmes' ),
		//		'parent'        => $panel_blog_lists,
		//		'options'       => array(
		//			'in-grid'    => esc_html__( 'In Grid', 'holmes' ),
		//			'full-width' => esc_html__( 'Full Width', 'holmes' )
		//		)
		//	)
		//);

		//holmes_mkdf_add_admin_field(
		//	array(
		//		'name'          => 'blog_masonry_number_of_columns',
		//		'type'          => 'select',
		//		'label'         => esc_html__( 'Masonry - Number of Columns', 'holmes' ),
		//		'default_value' => 'three',
		//		'description'   => esc_html__( 'Set number of columns for your masonry blog lists. Default value is 4 columns', 'holmes' ),
		//		'parent'        => $panel_blog_lists,
		//		'options'       => holmes_mkdf_get_number_of_columns_array( false, array( 'one', 'six' ) )
		//	)
		//);

		//holmes_mkdf_add_admin_field(
		//	array(
		//		'name'          => 'blog_masonry_space_between_items',
		//		'type'          => 'select',
		//		'label'         => esc_html__( 'Masonry - Space Between Items', 'holmes' ),
		//		'description'   => esc_html__( 'Set space size between posts for your masonry blog lists. Default value is normal', 'holmes' ),
		//		'default_value' => 'normal',
		//		'options'       => holmes_mkdf_get_space_between_items_array(),
		//		'parent'        => $panel_blog_lists
		//	)
		//);

		//holmes_mkdf_add_admin_field(
		//	array(
		//		'name'          => 'blog_list_featured_image_proportion',
		//		'type'          => 'select',
		//		'label'         => esc_html__( 'Masonry - Featured Image Proportion', 'holmes' ),
		//		'default_value' => 'fixed',
		//		'description'   => esc_html__( 'Choose type of proportions you want to use for featured images on masonry blog lists', 'holmes' ),
		//		'parent'        => $panel_blog_lists,
		//		'options'       => array(
		//			'fixed'    => esc_html__( 'Fixed', 'holmes' ),
		//			'original' => esc_html__( 'Original', 'holmes' )
		//		)
		//	)
		//);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'blog_pagination_type',
				'type'          => 'select',
				'label'         => esc_html__( 'Pagination Type', 'holmes' ),
				'description'   => esc_html__( 'Choose a pagination layout for Blog Lists', 'holmes' ),
				'parent'        => $panel_blog_lists,
				'default_value' => 'standard',
				'options'       => array(
					'standard'        => esc_html__( 'Standard', 'holmes' ),
					'load-more'       => esc_html__( 'Load More', 'holmes' ),
					'infinite-scroll' => esc_html__( 'Infinite Scroll', 'holmes' ),
					'no-pagination'   => esc_html__( 'No Pagination', 'holmes' )
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'number_of_chars',
				'default_value' => '40',
				'label'         => esc_html__( 'Number of Words in Excerpt', 'holmes' ),
				'description'   => esc_html__( 'Enter a number of words in excerpt (article summary). Default value is 40', 'holmes' ),
				'parent'        => $panel_blog_lists,
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'blog_list_tags',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Tags', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will show tags on blog list', 'holmes' ),
				'parent'        => $panel_blog_lists,
				'default_value' => 'yes'
			)
		);

		/**
		 * Blog Single
		 */
		$panel_blog_single = holmes_mkdf_add_admin_panel(
			array(
				'page'  => '_blog_page',
				'name'  => 'panel_blog_single',
				'title' => esc_html__( 'Blog Single', 'holmes' )
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'        => 'blog_single_grid_space',
				'type'        => 'select',
				'label'       => esc_html__( 'Grid Layout Space', 'holmes' ),
				'description' => esc_html__( 'Choose a space between content layout and sidebar layout for Blog Single pages. Default value is large', 'holmes' ),
				'options'     => holmes_mkdf_get_space_between_items_array( true ),
				'parent'      => $panel_blog_single
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'blog_single_sidebar_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'holmes' ),
				'description'   => esc_html__( 'Choose a sidebar layout for Blog Single pages', 'holmes' ),
				'default_value' => '',
				'parent'        => $panel_blog_single,
				'options'       => holmes_mkdf_get_custom_sidebars_options()
			)
		);

		if ( count( $holmes_custom_sidebars ) > 0 ) {
			holmes_mkdf_add_admin_field(
				array(
					'name'        => 'blog_single_custom_sidebar_area',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Sidebar to Display', 'holmes' ),
					'description' => esc_html__( 'Choose a sidebar to display on Blog Single pages. Default sidebar is "Sidebar"', 'holmes' ),
					'parent'      => $panel_blog_single,
					'options'     => holmes_mkdf_get_custom_sidebars(),
					'args'        => array(
						'select2' => true
					)
				)
			);
		}

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_blog',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single post pages', 'holmes' ),
				'parent'        => $panel_blog_single,
				'options'       => holmes_mkdf_get_yes_no_select_array(),
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'blog_single_title_in_title_area',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show Post Title in Title Area', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will show post title in title area on single post pages', 'holmes' ),
				'parent'        => $panel_blog_single,
				'dependency'    => array(
					'hide' => array(
						'show_title_area_blog' => 'no'
					)
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'blog_single_date',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Date', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will show date of publishing on single post pages in content area', 'holmes' ),
				'parent'        => $panel_blog_single,
				'default_value' => 'yes'
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'blog_single_categories',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Categories', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will show categories on single post pages in content area', 'holmes' ),
				'parent'        => $panel_blog_single,
				'default_value' => 'yes'
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'blog_single_tags',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Tags', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will show tags on single post pages in content area', 'holmes' ),
				'parent'        => $panel_blog_single,
				'default_value' => 'yes'
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'blog_single_related_posts',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Related Posts', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will show related posts on single post pages', 'holmes' ),
				'parent'        => $panel_blog_single,
				'default_value' => 'no'
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'blog_single_comments',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Comments Form', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will show comments form on single post pages', 'holmes' ),
				'parent'        => $panel_blog_single,
				'default_value' => 'yes'
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_single_navigation',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Prev/Next Single Post Navigation Links', 'holmes' ),
				'description'   => esc_html__( 'Enable navigation links through the blog posts (left and right arrows will appear)', 'holmes' ),
				'parent'        => $panel_blog_single
			)
		);

		$blog_single_navigation_container = holmes_mkdf_add_admin_container(
			array(
				'name'       => 'mkdf_blog_single_navigation_container',
				'parent'     => $panel_blog_single,
				'dependency' => array(
					'show' => array(
						'blog_single_navigation' => 'yes'
					)
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_navigation_through_same_category',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Navigation Only in Current Category', 'holmes' ),
				'description'   => esc_html__( 'Limit your navigation only through current category', 'holmes' ),
				'parent'        => $blog_single_navigation_container,
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_author_info',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Author Info Box', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will display author name and descriptions on single post pages. Author biographic info field in Users section must contain some data', 'holmes' ),
				'parent'        => $panel_blog_single
			)
		);

		$blog_single_author_info_container = holmes_mkdf_add_admin_container(
			array(
				'name'       => 'mkdf_blog_single_author_info_container',
				'parent'     => $panel_blog_single,
				'dependency' => array(
					'show' => array(
						'blog_author_info' => 'yes'
					)
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_author_info_email',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show Author Email', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will show author email', 'holmes' ),
				'parent'        => $blog_single_author_info_container,
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_single_author_social',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Author Social Icons', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will show author social icons on single post pages', 'holmes' ),
				'parent'        => $blog_single_author_info_container,
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		do_action( 'holmes_mkdf_blog_single_options_map', $panel_blog_single );
	}

	add_action( 'holmes_mkdf_options_map', 'holmes_mkdf_blog_options_map', holmes_mkdf_set_options_map_position( 'blog' ) );
}
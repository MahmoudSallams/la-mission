<?php

/*** Post Settings ***/

if ( ! function_exists( 'holmes_mkdf_map_post_meta' ) ) {
	function holmes_mkdf_map_post_meta() {
		
		$post_meta_box = holmes_mkdf_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Post', 'holmes' ),
				'name'  => 'post-meta'
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_show_title_area_blog_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single post page', 'holmes' ),
				'parent'        => $post_meta_box,
				'options'       => holmes_mkdf_get_yes_no_select_array()
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_blog_single_sidebar_layout_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'holmes' ),
				'description'   => esc_html__( 'Choose a sidebar layout for Blog single page', 'holmes' ),
				'default_value' => '',
				'parent'        => $post_meta_box,
                'options'       => holmes_mkdf_get_custom_sidebars_options( true )
			)
		);
		
		$holmes_custom_sidebars = holmes_mkdf_get_custom_sidebars();
		if ( count( $holmes_custom_sidebars ) > 0 ) {
			holmes_mkdf_create_meta_box_field( array(
				'name'        => 'mkdf_blog_single_custom_sidebar_area_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'holmes' ),
				'description' => esc_html__( 'Choose a sidebar to display on Blog single page. Default sidebar is "Sidebar"', 'holmes' ),
				'parent'      => $post_meta_box,
				'options'     => holmes_mkdf_get_custom_sidebars(),
				'args' => array(
					'select2' => true
				)
			) );
		}
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_blog_list_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Blog List Image', 'holmes' ),
				'description' => esc_html__( 'Choose an Image for displaying in blog list. If not uploaded, featured image will be shown.', 'holmes' ),
				'parent'      => $post_meta_box
			)
		);

		do_action('holmes_mkdf_blog_post_meta', $post_meta_box);
	}
	
	add_action( 'holmes_mkdf_meta_boxes_map', 'holmes_mkdf_map_post_meta', 20 );
}

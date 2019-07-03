<?php

if ( ! function_exists( 'holmes_mkdf_map_footer_meta' ) ) {
	function holmes_mkdf_map_footer_meta() {
		
		$footer_meta_box = holmes_mkdf_create_meta_box(
			array(
				'scope' => apply_filters( 'holmes_mkdf_set_scope_for_meta_boxes', array( 'page', 'post' ), 'footer_meta' ),
				'title' => esc_html__( 'Footer', 'holmes' ),
				'name'  => 'footer_meta'
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_disable_footer_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Disable Footer for this Page', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will hide footer on this page', 'holmes' ),
				'options'       => holmes_mkdf_get_yes_no_select_array(),
				'parent'        => $footer_meta_box
			)
		);
		
		$show_footer_meta_container = holmes_mkdf_add_admin_container(
			array(
				'name'       => 'mkdf_show_footer_meta_container',
				'parent'     => $footer_meta_box,
				'dependency' => array(
					'hide' => array(
						'mkdf_disable_footer_meta' => 'yes'
					)
				)
			)
		);
		
			holmes_mkdf_create_meta_box_field(
				array(
					'name'          => 'mkdf_footer_in_grid_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Footer in Grid', 'holmes' ),
					'description'   => esc_html__( 'Enabling this option will place Footer content in grid', 'holmes' ),
					'options'       => holmes_mkdf_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
			
			holmes_mkdf_create_meta_box_field(
				array(
					'name'          => 'mkdf_uncovering_footer_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Uncovering Footer', 'holmes' ),
					'description'   => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'holmes' ),
					'options'       => holmes_mkdf_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
		
			holmes_mkdf_create_meta_box_field(
				array(
					'name'          => 'mkdf_show_footer_top_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Show Footer Top', 'holmes' ),
					'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'holmes' ),
					'options'       => holmes_mkdf_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
		
			holmes_mkdf_create_meta_box_field(
				array(
					'name'        => 'mkdf_footer_top_background_color_meta',
					'type'        => 'color',
					'label'       => esc_html__( 'Footer Top Background Color', 'holmes' ),
					'description' => esc_html__( 'Set background color for top footer area', 'holmes' ),
					'parent'      => $show_footer_meta_container,
					'dependency' => array(
						'show' => array(
							'mkdf_show_footer_top_meta' => array( '', 'yes' )
						)
					)
				)
			);
			
			holmes_mkdf_create_meta_box_field(
				array(
					'name'          => 'mkdf_show_footer_bottom_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Show Footer Bottom', 'holmes' ),
					'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'holmes' ),
					'options'       => holmes_mkdf_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
		
			holmes_mkdf_create_meta_box_field(
				array(
					'name'        => 'mkdf_footer_bottom_background_color_meta',
					'type'        => 'color',
					'label'       => esc_html__( 'Footer Bottom Background Color', 'holmes' ),
					'description' => esc_html__( 'Set background color for bottom footer area', 'holmes' ),
					'parent'      => $show_footer_meta_container,
					'dependency' => array(
						'show' => array(
							'mkdf_show_footer_bottom_meta' => array( '', 'yes' )
						)
					)
				)
			);
	}
	
	add_action( 'holmes_mkdf_meta_boxes_map', 'holmes_mkdf_map_footer_meta', 70 );
}
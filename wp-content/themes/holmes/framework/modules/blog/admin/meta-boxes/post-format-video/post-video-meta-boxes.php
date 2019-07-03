<?php

if ( ! function_exists( 'holmes_mkdf_map_post_video_meta' ) ) {
	function holmes_mkdf_map_post_video_meta() {
		$video_post_format_meta_box = holmes_mkdf_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Video Post Format', 'holmes' ),
				'name'  => 'post_format_video_meta'
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_video_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Video Type', 'holmes' ),
				'description'   => esc_html__( 'Choose video type', 'holmes' ),
				'parent'        => $video_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Video Service', 'holmes' ),
					'self'            => esc_html__( 'Self Hosted', 'holmes' )
				)
			)
		);
		
		$mkdf_video_embedded_container = holmes_mkdf_add_admin_container(
			array(
				'parent' => $video_post_format_meta_box,
				'name'   => 'mkdf_video_embedded_container'
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_post_video_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video URL', 'holmes' ),
				'description' => esc_html__( 'Enter Video URL', 'holmes' ),
				'parent'      => $mkdf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'mkdf_video_type_meta' => 'social_networks'
					)
				)
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_post_video_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video MP4', 'holmes' ),
				'description' => esc_html__( 'Enter video URL for MP4 format', 'holmes' ),
				'parent'      => $mkdf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'mkdf_video_type_meta' => 'self'
					)
				)
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_post_video_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Video Image', 'holmes' ),
				'description' => esc_html__( 'Enter video image', 'holmes' ),
				'parent'      => $mkdf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'mkdf_video_type_meta' => 'self'
					)
				)
			)
		);
	}
	
	add_action( 'holmes_mkdf_meta_boxes_map', 'holmes_mkdf_map_post_video_meta', 22 );
}
<?php

if ( ! function_exists( 'holmes_core_map_portfolio_meta' ) ) {
	function holmes_core_map_portfolio_meta() {
		global $holmes_Framework;
		
		$holmes_pages = array();
		$pages      = get_pages();
		foreach ( $pages as $page ) {
			$holmes_pages[ $page->ID ] = $page->post_title;
		}
		
		//Portfolio Images
		
		$holmes_portfolio_images = new HolmesMkdfMetaBox( 'portfolio-item', esc_html__( 'Portfolio Images (multiple upload)', 'holmes-core' ), '', '', 'portfolio_images' );
		$holmes_Framework->mikadoMetaBoxes->addMetaBox( 'portfolio_images', $holmes_portfolio_images );
		
		$holmes_portfolio_image_gallery = new HolmesMkdfMultipleImages( 'mkdf-portfolio-image-gallery', esc_html__( 'Portfolio Images', 'holmes-core' ), esc_html__( 'Choose your portfolio images', 'holmes-core' ) );
		$holmes_portfolio_images->addChild( 'mkdf-portfolio-image-gallery', $holmes_portfolio_image_gallery );
		
		//Portfolio Single Upload Images/Videos 
		
		$holmes_portfolio_images_videos = holmes_mkdf_create_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Portfolio Images/Videos (single upload)', 'holmes-core' ),
				'name'  => 'mkdf_portfolio_images_videos'
			)
		);
		holmes_mkdf_add_repeater_field(
			array(
				'name'        => 'mkdf_portfolio_single_upload',
				'parent'      => $holmes_portfolio_images_videos,
				'button_text' => esc_html__( 'Add Image/Video', 'holmes-core' ),
				'fields'      => array(
					array(
						'type'        => 'select',
						'name'        => 'file_type',
						'label'       => esc_html__( 'File Type', 'holmes-core' ),
						'options' => array(
							'image' => esc_html__('Image','holmes-core'),
							'video' => esc_html__('Video','holmes-core'),
						)
					),
					array(
						'type'        => 'image',
						'name'        => 'single_image',
						'label'       => esc_html__( 'Image', 'holmes-core' ),
						'dependency' => array(
							'show' => array(
								'file_type'  => 'image'
							)
						)
					),
					array(
						'type'        => 'select',
						'name'        => 'video_type',
						'label'       => esc_html__( 'Video Type', 'holmes-core' ),
						'options'	  => array(
							'youtube' => esc_html__('YouTube', 'holmes-core'),
							'vimeo' => esc_html__('Vimeo', 'holmes-core'),
							'self' => esc_html__('Self Hosted', 'holmes-core'),
						),
						'dependency' => array(
							'show' => array(
								'file_type'  => 'video'
							)
						)
					),
					array(
						'type'        => 'text',
						'name'        => 'video_id',
						'label'       => esc_html__( 'Video ID', 'holmes-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => array('youtube','vimeo')
							)
						)
					),
					array(
						'type'        => 'text',
						'name'        => 'video_mp4',
						'label'       => esc_html__( 'Video mp4', 'holmes-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => 'self'
							)
						)
					),
					array(
						'type'        => 'image',
						'name'        => 'video_cover_image',
						'label'       => esc_html__( 'Video Cover Image', 'holmes-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => 'self'
							)
						)
					)
				)
			)
		);
		
		//Portfolio Additional Sidebar Items
		
		$holmes_additional_sidebar_items = holmes_mkdf_create_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Additional Portfolio Sidebar Items', 'holmes-core' ),
				'name'  => 'portfolio_properties'
			)
		);

		holmes_mkdf_add_repeater_field(
			array(
				'name'        => 'mkdf_portfolio_properties',
				'parent'      => $holmes_additional_sidebar_items,
				'button_text' => esc_html__( 'Add New Item', 'holmes-core' ),
				'fields'      => array(
					array(
						'type'        => 'text',
						'name'        => 'item_title',
						'label'       => esc_html__( 'Item Title', 'holmes-core' ),
					),
					array(
						'type'        => 'text',
						'name'        => 'item_text',
						'label'       => esc_html__( 'Item Text', 'holmes-core' )
					),
					array(
						'type'        => 'text',
						'name'        => 'item_url',
						'label'       => esc_html__( 'Enter Full URL for Item Text Link', 'holmes-core' )
					)
				)
			)
		);
	}
	
	add_action( 'holmes_mkdf_meta_boxes_map', 'holmes_core_map_portfolio_meta', 40 );
}
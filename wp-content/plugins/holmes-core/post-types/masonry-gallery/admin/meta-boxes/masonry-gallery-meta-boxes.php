<?php

if ( ! function_exists( 'holmes_core_map_masonry_gallery_meta' ) ) {
	function holmes_core_map_masonry_gallery_meta() {
		
		$masonry_gallery_meta_box = holmes_mkdf_create_meta_box(
			array(
				'scope' => array( 'masonry-gallery' ),
				'title' => esc_html__( 'Masonry Gallery General', 'holmes-core' ),
				'name'  => 'masonry_gallery_meta'
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_masonry_gallery_item_title_tag',
				'type'          => 'select',
				'default_value' => 'h4',
				'label'         => esc_html__( 'Title Tag', 'holmes-core' ),
				'parent'        => $masonry_gallery_meta_box,
				'options'       => holmes_mkdf_get_title_tag()
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'   => 'mkdf_masonry_gallery_item_text',
				'type'   => 'text',
				'label'  => esc_html__( 'Text', 'holmes-core' ),
				'parent' => $masonry_gallery_meta_box
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'   => 'mkdf_masonry_gallery_item_image',
				'type'   => 'image',
				'label'  => esc_html__( 'Custom Item Icon', 'holmes-core' ),
				'parent' => $masonry_gallery_meta_box
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'   => 'mkdf_masonry_gallery_item_link',
				'type'   => 'text',
				'label'  => esc_html__( 'Link', 'holmes-core' ),
				'parent' => $masonry_gallery_meta_box
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_masonry_gallery_item_link_target',
				'type'          => 'select',
				'default_value' => '_self',
				'label'         => esc_html__( 'Link Target', 'holmes-core' ),
				'parent'        => $masonry_gallery_meta_box,
				'options'       => holmes_mkdf_get_link_target_array()
			)
		);
		
		holmes_mkdf_add_admin_section_title( array(
			'name'   => 'mkdf_section_style_title',
			'parent' => $masonry_gallery_meta_box,
			'title'  => esc_html__( 'Masonry Gallery Item Style', 'holmes-core' )
		) );
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_masonry_gallery_item_size',
				'type'          => 'select',
				'default_value' => 'small',
				'label'         => esc_html__( 'Size', 'holmes-core' ),
				'parent'        => $masonry_gallery_meta_box,
				'options'       => array(
					'small'              => esc_html__( 'Small', 'holmes-core' ),
					'large-width'        => esc_html__( 'Large Width', 'holmes-core' ),
					'large-height'       => esc_html__( 'Large Height', 'holmes-core' ),
					'large-width-height' => esc_html__( 'Large Width/Height', 'holmes-core' )
				)
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_masonry_gallery_item_type',
				'type'          => 'select',
				'default_value' => 'standard',
				'label'         => esc_html__( 'Type', 'holmes-core' ),
				'parent'        => $masonry_gallery_meta_box,
				'options'       => array(
					'standard'    => esc_html__( 'Standard', 'holmes-core' ),
					'with-button' => esc_html__( 'With Button', 'holmes-core' ),
					'simple'      => esc_html__( 'Simple', 'holmes-core' )
				)
			)
		);
		
		$masonry_gallery_item_button_type_container = holmes_mkdf_add_admin_container_no_style(
			array(
				'name'            => 'masonry_gallery_item_button_type_container',
				'parent'          => $masonry_gallery_meta_box,
				'dependency' => array(
					'hide' => array(
						'mkdf_masonry_gallery_item_type'  => array( 'standard', 'simple' )
					)
				)
			)
		);
		
		holmes_mkdf_create_meta_box_field(
			array(
				'name'   => 'mkdf_masonry_gallery_button_label',
				'type'   => 'text',
				'label'  => esc_html__( 'Button Label', 'holmes-core' ),
				'parent' => $masonry_gallery_item_button_type_container
			)
		);
		
		$masonry_gallery_item_simple_type_container = holmes_mkdf_add_admin_container_no_style(
			array(
				'name'            => 'masonry_gallery_item_simple_type_container',
				'parent'          => $masonry_gallery_meta_box,
				'dependency' => array(
					'hide' => array(
						'mkdf_masonry_gallery_item_type'  => array( 'standard', 'with-button' )
					)
				)
			)
		);

        holmes_mkdf_create_meta_box_field(
            array(
                'name'          => 'mkdf_masonry_gallery_simple_word_color',
                'type'          => 'color',
                'default_value' => '',
                'label'         => esc_html__( 'Last word color', 'holmes-core' ),
                'parent'        => $masonry_gallery_item_simple_type_container
            )
        );

		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_masonry_gallery_simple_content_background_skin',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Content Background Skin', 'holmes-core' ),
				'parent'        => $masonry_gallery_item_simple_type_container,
				'options'       => array(
					'default' => esc_html__( 'Default', 'holmes-core' ),
					'light'   => esc_html__( 'Light', 'holmes-core' ),
					'dark'    => esc_html__( 'Dark', 'holmes-core' )
				)
			)
		);
	}
	
	add_action( 'holmes_mkdf_meta_boxes_map', 'holmes_core_map_masonry_gallery_meta', 45 );
}
<?php

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if ( function_exists( 'vc_set_as_theme' ) ) {
	vc_set_as_theme( true );
}

/**
 * Change path for overridden templates
 */
if ( function_exists( 'vc_set_shortcodes_templates_dir' ) ) {
	$dir = MIKADO_ROOT_DIR . '/vc-templates';
	vc_set_shortcodes_templates_dir( $dir );
}

if ( ! function_exists( 'holmes_mkdf_configure_visual_composer_frontend_editor' ) ) {
	/**
	 * Configuration for Visual Composer FrontEnd Editor
	 * Hooks on vc_after_init action
	 */
	function holmes_mkdf_configure_visual_composer_frontend_editor() {
		/**
		 * Remove frontend editor
		 */
		if ( function_exists( 'vc_disable_frontend' ) ) {
			vc_disable_frontend();
		}
	}
	
	add_action( 'vc_after_init', 'holmes_mkdf_configure_visual_composer_frontend_editor' );
}

if ( ! function_exists( 'holmes_mkdf_vc_row_map' ) ) {
	/**
	 * Map VC Row shortcode
	 * Hooks on vc_after_init action
	 */
	function holmes_mkdf_vc_row_map() {
		
		/******* VC Row shortcode - begin *******/
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_content_width',
				'heading'    => esc_html__( 'Mikado Row Content Width', 'holmes' ),
				'value'      => array(
					esc_html__( 'Full Width', 'holmes' ) => 'full-width',
					esc_html__( 'In Grid', 'holmes' )    => 'grid'
				),
				'group'      => esc_html__( 'Mikado Settings', 'holmes' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'anchor',
				'heading'     => esc_html__( 'Mikado Anchor ID', 'holmes' ),
				'description' => esc_html__( 'For example "home"', 'holmes' ),
				'group'       => esc_html__( 'Mikado Settings', 'holmes' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'simple_background_color',
				'heading'    => esc_html__( 'Mikado Background Color', 'holmes' ),
				'group'      => esc_html__( 'Mikado Settings', 'holmes' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'attach_image',
				'param_name' => 'simple_background_image',
				'heading'    => esc_html__( 'Mikado Background Image', 'holmes' ),
				'group'      => esc_html__( 'Mikado Settings', 'holmes' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'background_image_position',
				'heading'     => esc_html__( 'Mikado Background Position', 'holmes' ),
				'description' => esc_html__( 'Set the starting position of a background image, default value is top left', 'holmes' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Mikado Settings', 'holmes' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_background_image',
				'heading'     => esc_html__( 'Mikado Disable Background Image', 'holmes' ),
				'value'       => array(
					esc_html__( 'Never', 'holmes' )        => '',
					esc_html__( 'Below 1280px', 'holmes' ) => '1280',
					esc_html__( 'Below 1024px', 'holmes' ) => '1024',
					esc_html__( 'Below 768px', 'holmes' )  => '768',
					esc_html__( 'Below 680px', 'holmes' )  => '680',
					esc_html__( 'Below 480px', 'holmes' )  => '480'
				),
				'save_always' => true,
				'description' => esc_html__( 'Choose on which stage you hide row background image', 'holmes' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Mikado Settings', 'holmes' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'attach_image',
				'param_name' => 'parallax_background_image',
				'heading'    => esc_html__( 'Mikado Parallax Background Image', 'holmes' ),
				'group'      => esc_html__( 'Mikado Settings', 'holmes' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'parallax_bg_speed',
				'heading'     => esc_html__( 'Mikado Parallax Speed', 'holmes' ),
				'description' => esc_html__( 'Set your parallax speed. Default value is 1.', 'holmes' ),
				'dependency'  => array( 'element' => 'parallax_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Mikado Settings', 'holmes' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'parallax_bg_height',
				'heading'    => esc_html__( 'Mikado Parallax Section Height (px)', 'holmes' ),
				'dependency' => array( 'element' => 'parallax_background_image', 'not_empty' => true ),
				'group'      => esc_html__( 'Mikado Settings', 'holmes' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'content_text_aligment',
				'heading'    => esc_html__( 'Mikado Content Aligment', 'holmes' ),
				'value'      => array(
					esc_html__( 'Default', 'holmes' ) => '',
					esc_html__( 'Left', 'holmes' )    => 'left',
					esc_html__( 'Center', 'holmes' )  => 'center',
					esc_html__( 'Right', 'holmes' )   => 'right'
				),
				'group'      => esc_html__( 'Mikado Settings', 'holmes' )
			)
		);

        vc_add_param( 'vc_row',
            array(
                'type'       => 'textfield',
                'param_name' => 'row_background_text_1',
                'heading'    => esc_html__( 'Select Background Text 1', 'holmes' ),
                'group'      => esc_html__( 'Mikado Settings', 'holmes' )
            )
        );

        vc_add_param( 'vc_row',
            array(
                'type'       => 'textfield',
                'param_name' => 'row_background_text_2',
                'heading'    => esc_html__( 'Select Background Text 2', 'holmes' ),
                'dependency' => array( 'element' => 'row_background_text_1', 'not_empty' => true ),
                'group'      => esc_html__( 'Mikado Settings', 'holmes' )
            )
        );

        vc_add_param( 'vc_row',
            array(
                'type'       => 'textfield',
                'param_name' => 'row_background_text_size',
                'heading'    => esc_html__( 'Select Background Text Size', 'holmes' ),
                'description' => esc_html__( 'Set the background text size in px or em', 'holmes' ),
                'dependency' => array( 'element' => 'row_background_text_1', 'not_empty' => true ),
                'group'      => esc_html__( 'Mikado Settings', 'holmes' )
            )
        );

        vc_add_param( 'vc_row',
            array(
                'type'       => 'textfield',
                'param_name' => 'row_background_text_size_1440',
                'heading'    => esc_html__( 'Select Background Text Size 1280px-1440px', 'holmes' ),
                'description' => esc_html__( 'Set the background text size in px or em', 'holmes' ),
                'dependency' => array( 'element' => 'row_background_text_1', 'not_empty' => true ),
                'group'      => esc_html__( 'Mikado Settings', 'holmes' )
            )
        );

        vc_add_param( 'vc_row',
            array(
                'type'       => 'textfield',
                'param_name' => 'row_background_text_size_1280',
                'heading'    => esc_html__( 'Select Background Text Size 1024px-1280px', 'holmes' ),
                'description' => esc_html__( 'Set the background text size in px or em', 'holmes' ),
                'dependency' => array( 'element' => 'row_background_text_1', 'not_empty' => true ),
                'group'      => esc_html__( 'Mikado Settings', 'holmes' )
            )
        );

        vc_add_param( 'vc_row',
            array(
                'type'       => 'colorpicker',
                'param_name' => 'row_background_text_color',
                'heading'    => esc_html__( 'Select Background Text Color', 'holmes' ),
                'dependency' => array( 'element' => 'row_background_text_1', 'not_empty' => true ),
                'group'      => esc_html__( 'Mikado Settings', 'holmes' )
            )
        );

        vc_add_param( 'vc_row',
            array(
                'type'       => 'dropdown',
                'param_name' => 'row_background_text_align',
                'heading'    => esc_html__( 'Select Background Text Align', 'holmes' ),
                'value'      => array(
                    esc_html__( 'Default', 'holmes' ) => '',
                    esc_html__( 'Left', 'holmes' )    => 'left',
                    esc_html__( 'Center', 'holmes' )  => 'center',
                    esc_html__( 'Right', 'holmes' )   => 'right'
                ),
                'dependency' => array( 'element' => 'row_background_text_1', 'not_empty' => true ),
                'group'      => esc_html__( 'Mikado Settings', 'holmes' )
            )
        );

        vc_add_param( 'vc_row',
            array(
                'type'       => 'dropdown',
                'param_name' => 'row_background_text_vertical_align',
                'heading'    => esc_html__( 'Select Background Vertical Align', 'holmes' ),
                'value'      => array(
                    esc_html__( 'Middle', 'holmes' )   => 'middle',
                    esc_html__( 'Top', 'holmes' )      => 'top',
                    esc_html__( 'Bottom', 'holmes' )   => 'bottom'
                ),
                'dependency' => array( 'element' => 'row_background_text_1', 'not_empty' => true ),
                'group'      => esc_html__( 'Mikado Settings', 'holmes' )
            )
        );

        vc_add_param( 'vc_row',
            array(
                'type'       => 'textfield',
                'param_name' => 'row_background_text_padding_top',
                'heading'    => esc_html__( 'Select Background Text Top Padding', 'holmes' ),
                'description' => esc_html__( 'Set the value of top padding in px or %', 'holmes' ),
                'dependency' => array( 'element' => 'row_background_text_1', 'not_empty' => true ),
                'group'      => esc_html__( 'Mikado Settings', 'holmes' )
            )
        );

        vc_add_param( 'vc_row',
            array(
                'type'       => 'dropdown',
                'param_name' => 'row_background_text_animation',
                'heading'    => esc_html__( 'Animate Background Text', 'holmes' ),
                'value'      => array_flip( holmes_mkdf_get_yes_no_select_array(false, true) ),
                'dependency' => array( 'element' => 'row_background_text_1', 'not_empty' => true ),
                'description'    => esc_html__( 'Animate background text when row appears in viewport', 'holmes' ),
                'group'      => esc_html__( 'Mikado Settings', 'holmes' )
            )
        );
		
		/******* VC Row shortcode - end *******/
		
		/******* VC Row Inner shortcode - begin *******/
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_content_width',
				'heading'    => esc_html__( 'Mikado Row Content Width', 'holmes' ),
				'value'      => array(
					esc_html__( 'Full Width', 'holmes' ) => 'full-width',
					esc_html__( 'In Grid', 'holmes' )    => 'grid'
				),
				'group'      => esc_html__( 'Mikado Settings', 'holmes' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'simple_background_color',
				'heading'    => esc_html__( 'Mikado Background Color', 'holmes' ),
				'group'      => esc_html__( 'Mikado Settings', 'holmes' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'attach_image',
				'param_name' => 'simple_background_image',
				'heading'    => esc_html__( 'Mikado Background Image', 'holmes' ),
				'group'      => esc_html__( 'Mikado Settings', 'holmes' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'textfield',
				'param_name'  => 'background_image_position',
				'heading'     => esc_html__( 'Mikado Background Position', 'holmes' ),
				'description' => esc_html__( 'Set the starting position of a background image, default value is top left', 'holmes' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Mikado Settings', 'holmes' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_background_image',
				'heading'     => esc_html__( 'Mikado Disable Background Image', 'holmes' ),
				'value'       => array(
					esc_html__( 'Never', 'holmes' )        => '',
					esc_html__( 'Below 1280px', 'holmes' ) => '1280',
					esc_html__( 'Below 1024px', 'holmes' ) => '1024',
					esc_html__( 'Below 768px', 'holmes' )  => '768',
					esc_html__( 'Below 680px', 'holmes' )  => '680',
					esc_html__( 'Below 480px', 'holmes' )  => '480'
				),
				'save_always' => true,
				'description' => esc_html__( 'Choose on which stage you hide row background image', 'holmes' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Mikado Settings', 'holmes' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'content_text_aligment',
				'heading'    => esc_html__( 'Mikado Content Aligment', 'holmes' ),
				'value'      => array(
					esc_html__( 'Default', 'holmes' ) => '',
					esc_html__( 'Left', 'holmes' )    => 'left',
					esc_html__( 'Center', 'holmes' )  => 'center',
					esc_html__( 'Right', 'holmes' )   => 'right'
				),
				'group'      => esc_html__( 'Mikado Settings', 'holmes' )
			)
		);
		
		/******* VC Row Inner shortcode - end *******/
		
		/******* VC Revolution Slider shortcode - begin *******/
		
		if ( holmes_mkdf_revolution_slider_installed() ) {
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'enable_paspartu',
					'heading'     => esc_html__( 'Mikado Enable Passepartout', 'holmes' ),
					'value'       => array_flip( holmes_mkdf_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'group'       => esc_html__( 'Mikado Settings', 'holmes' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'paspartu_size',
					'heading'     => esc_html__( 'Mikado Passepartout Size', 'holmes' ),
					'value'       => array(
						esc_html__( 'Tiny', 'holmes' )   => 'tiny',
						esc_html__( 'Small', 'holmes' )  => 'small',
						esc_html__( 'Normal', 'holmes' ) => 'normal',
						esc_html__( 'Large', 'holmes' )  => 'large'
					),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Mikado Settings', 'holmes' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'disable_side_paspartu',
					'heading'     => esc_html__( 'Mikado Disable Side Passepartout', 'holmes' ),
					'value'       => array_flip( holmes_mkdf_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Mikado Settings', 'holmes' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'disable_top_paspartu',
					'heading'     => esc_html__( 'Mikado Disable Top Passepartout', 'holmes' ),
					'value'       => array_flip( holmes_mkdf_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Mikado Settings', 'holmes' )
				)
			);
		}
		
		/******* VC Revolution Slider shortcode - end *******/
	}
	
	add_action( 'vc_after_init', 'holmes_mkdf_vc_row_map' );
}
<?php

if ( ! function_exists( 'holmes_mkdf_general_options_map' ) ) {
	/**
	 * General options page
	 */
	function holmes_mkdf_general_options_map() {

		holmes_mkdf_add_admin_page(
			array(
				'slug'  => '',
				'title' => esc_html__( 'General', 'holmes' ),
				'icon'  => 'fa fa-institution'
			)
		);

		$panel_design_style = holmes_mkdf_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_design_style',
				'title' => esc_html__( 'Design Style', 'holmes' )
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'google_fonts',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Google Font Family', 'holmes' ),
				'description'   => esc_html__( 'Choose a default Google font for your site', 'holmes' ),
				'parent'        => $panel_design_style
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'additional_google_fonts',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Additional Google Fonts', 'holmes' ),
				'parent'        => $panel_design_style
			)
		);

		$additional_google_fonts_container = holmes_mkdf_add_admin_container(
			array(
				'parent'     => $panel_design_style,
				'name'       => 'additional_google_fonts_container',
				'dependency' => array(
					'show' => array(
						'additional_google_fonts' => 'yes'
					)
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'additional_google_font1',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'holmes' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'holmes' ),
				'parent'        => $additional_google_fonts_container
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'additional_google_font2',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'holmes' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'holmes' ),
				'parent'        => $additional_google_fonts_container
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'additional_google_font3',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'holmes' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'holmes' ),
				'parent'        => $additional_google_fonts_container
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'additional_google_font4',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'holmes' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'holmes' ),
				'parent'        => $additional_google_fonts_container
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'additional_google_font5',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'holmes' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'holmes' ),
				'parent'        => $additional_google_fonts_container
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'google_font_weight',
				'type'          => 'checkboxgroup',
				'default_value' => '',
				'label'         => esc_html__( 'Google Fonts Style & Weight', 'holmes' ),
				'description'   => esc_html__( 'Choose a default Google font weights for your site. Impact on page load time', 'holmes' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'100'  => esc_html__( '100 Thin', 'holmes' ),
					'100i' => esc_html__( '100 Thin Italic', 'holmes' ),
					'200'  => esc_html__( '200 Extra-Light', 'holmes' ),
					'200i' => esc_html__( '200 Extra-Light Italic', 'holmes' ),
					'300'  => esc_html__( '300 Light', 'holmes' ),
					'300i' => esc_html__( '300 Light Italic', 'holmes' ),
					'400'  => esc_html__( '400 Regular', 'holmes' ),
					'400i' => esc_html__( '400 Regular Italic', 'holmes' ),
					'500'  => esc_html__( '500 Medium', 'holmes' ),
					'500i' => esc_html__( '500 Medium Italic', 'holmes' ),
					'600'  => esc_html__( '600 Semi-Bold', 'holmes' ),
					'600i' => esc_html__( '600 Semi-Bold Italic', 'holmes' ),
					'700'  => esc_html__( '700 Bold', 'holmes' ),
					'700i' => esc_html__( '700 Bold Italic', 'holmes' ),
					'800'  => esc_html__( '800 Extra-Bold', 'holmes' ),
					'800i' => esc_html__( '800 Extra-Bold Italic', 'holmes' ),
					'900'  => esc_html__( '900 Ultra-Bold', 'holmes' ),
					'900i' => esc_html__( '900 Ultra-Bold Italic', 'holmes' )
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'google_font_subset',
				'type'          => 'checkboxgroup',
				'default_value' => '',
				'label'         => esc_html__( 'Google Fonts Subset', 'holmes' ),
				'description'   => esc_html__( 'Choose a default Google font subsets for your site', 'holmes' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'latin'        => esc_html__( 'Latin', 'holmes' ),
					'latin-ext'    => esc_html__( 'Latin Extended', 'holmes' ),
					'cyrillic'     => esc_html__( 'Cyrillic', 'holmes' ),
					'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'holmes' ),
					'greek'        => esc_html__( 'Greek', 'holmes' ),
					'greek-ext'    => esc_html__( 'Greek Extended', 'holmes' ),
					'vietnamese'   => esc_html__( 'Vietnamese', 'holmes' )
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'        => 'first_color',
				'type'        => 'color',
				'label'       => esc_html__( 'First Main Color', 'holmes' ),
				'description' => esc_html__( 'Choose the most dominant theme color. Default color is #00bbb3', 'holmes' ),
				'parent'      => $panel_design_style
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'        => 'page_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Page Background Color', 'holmes' ),
				'description' => esc_html__( 'Choose the background color for page content. Default color is #ffffff', 'holmes' ),
				'parent'      => $panel_design_style
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'        => 'page_background_image',
				'type'        => 'image',
				'label'       => esc_html__( 'Page Background Image', 'holmes' ),
				'description' => esc_html__( 'Choose the background image for page content', 'holmes' ),
				'parent'      => $panel_design_style
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'page_background_image_repeat',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Page Background Image Repeat', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will set the background image as a repeating pattern throughout the page, otherwise the image will appear as the cover background image', 'holmes' ),
				'parent'        => $panel_design_style
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'        => 'selection_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Text Selection Color', 'holmes' ),
				'description' => esc_html__( 'Choose the color users see when selecting text', 'holmes' ),
				'parent'      => $panel_design_style
			)
		);

		/***************** Passepartout Layout - begin **********************/

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'boxed',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Boxed Layout', 'holmes' ),
				'parent'        => $panel_design_style
			)
		);

		$boxed_container = holmes_mkdf_add_admin_container(
			array(
				'parent'     => $panel_design_style,
				'name'       => 'boxed_container',
				'dependency' => array(
					'show' => array(
						'boxed' => 'yes'
					)
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'        => 'page_background_color_in_box',
				'type'        => 'color',
				'label'       => esc_html__( 'Page Background Color', 'holmes' ),
				'description' => esc_html__( 'Choose the page background color outside box', 'holmes' ),
				'parent'      => $boxed_container
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'        => 'boxed_background_image',
				'type'        => 'image',
				'label'       => esc_html__( 'Background Image', 'holmes' ),
				'description' => esc_html__( 'Choose an image to be displayed in background', 'holmes' ),
				'parent'      => $boxed_container
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'        => 'boxed_pattern_background_image',
				'type'        => 'image',
				'label'       => esc_html__( 'Background Pattern', 'holmes' ),
				'description' => esc_html__( 'Choose an image to be used as background pattern', 'holmes' ),
				'parent'      => $boxed_container
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'boxed_background_image_attachment',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Background Image Attachment', 'holmes' ),
				'description'   => esc_html__( 'Choose background image attachment', 'holmes' ),
				'parent'        => $boxed_container,
				'options'       => array(
					''       => esc_html__( 'Default', 'holmes' ),
					'fixed'  => esc_html__( 'Fixed', 'holmes' ),
					'scroll' => esc_html__( 'Scroll', 'holmes' )
				)
			)
		);

		/***************** Boxed Layout - end **********************/

		/***************** Passepartout Layout - begin **********************/

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'paspartu',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Passepartout', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'holmes' ),
				'parent'        => $panel_design_style
			)
		);

		$paspartu_container = holmes_mkdf_add_admin_container(
			array(
				'parent'     => $panel_design_style,
				'name'       => 'paspartu_container',
				'dependency' => array(
					'show' => array(
						'paspartu' => 'yes'
					)
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'        => 'paspartu_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Passepartout Color', 'holmes' ),
				'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'holmes' ),
				'parent'      => $paspartu_container
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'        => 'paspartu_width',
				'type'        => 'text',
				'label'       => esc_html__( 'Passepartout Size', 'holmes' ),
				'description' => esc_html__( 'Enter size amount for passepartout', 'holmes' ),
				'parent'      => $paspartu_container,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px or %'
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'        => 'paspartu_responsive_width',
				'type'        => 'text',
				'label'       => esc_html__( 'Responsive Passepartout Size', 'holmes' ),
				'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (tablets and mobiles view)', 'holmes' ),
				'parent'      => $paspartu_container,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px or %'
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent'        => $paspartu_container,
				'type'          => 'yesno',
				'default_value' => 'no',
				'name'          => 'disable_top_paspartu',
				'label'         => esc_html__( 'Disable Top Passepartout', 'holmes' )
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'parent'        => $paspartu_container,
				'type'          => 'yesno',
				'default_value' => 'no',
				'name'          => 'enable_fixed_paspartu',
				'label'         => esc_html__( 'Enable Fixed Passepartout', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will set fixed passepartout for your screens', 'holmes' )
			)
		);

		/***************** Passepartout Layout - end **********************/

		/***************** Content Layout - begin **********************/

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'initial_content_width',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'holmes' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'holmes' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'mkdf-grid-1100' => esc_html__( '1100px - default', 'holmes' ),
					'mkdf-grid-1300' => esc_html__( '1300px', 'holmes' ),
					'mkdf-grid-1200' => esc_html__( '1200px', 'holmes' ),
					'mkdf-grid-1000' => esc_html__( '1000px', 'holmes' ),
					'mkdf-grid-800'  => esc_html__( '800px', 'holmes' )
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'        => 'preload_pattern_image',
				'type'        => 'image',
				'label'       => esc_html__( 'Preload Pattern Image', 'holmes' ),
				'description' => esc_html__( 'Choose preload pattern image to be displayed until images are loaded', 'holmes' ),
				'parent'      => $panel_design_style
			)
		);

		/***************** Content Layout - end **********************/

		$panel_settings = holmes_mkdf_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_settings',
				'title' => esc_html__( 'Settings', 'holmes' )
			)
		);

		/***************** Smooth Scroll Layout - begin **********************/

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'page_smooth_scroll',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Smooth Scroll', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth scrolling effect on every page (except on Mac and touch devices)', 'holmes' ),
				'parent'        => $panel_settings
			)
		);

		/***************** Smooth Scroll Layout - end **********************/

		/***************** Scrollbar Skin Layout - begin **********************/

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'scrollbar_skin',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Predefined Scrollbar Skin', 'holmes' ),
				'description'   => esc_html__( 'Enable predefined scrollbar skin. This feature has partial browser support.', 'holmes' ),
				'parent'        => $panel_settings
			)
		);

		/***************** Scrollbar Skin Layout - end **********************/

		/***************** Grayscale Animation Layout - begin **********************/

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'grayscale_animation',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Image Grayscale Animation', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will perform a grayscale animation on images when they come into view. The effect is disabled on non-supporting browsers.', 'holmes' ),
				'parent'        => $panel_settings
			)
		);

		/***************** Grayscale Animation Layout - end **********************/

		/***************** Smooth Page Transitions Layout - begin **********************/

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'smooth_page_transitions',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Smooth Page Transitions', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'holmes' ),
				'parent'        => $panel_settings
			)
		);

		$page_transitions_container = holmes_mkdf_add_admin_container(
			array(
				'parent'     => $panel_settings,
				'name'       => 'page_transitions_container',
				'dependency' => array(
					'show' => array(
						'smooth_page_transitions' => 'yes'
					)
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'page_transition_preloader',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Preloading Animation', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'holmes' ),
				'parent'        => $page_transitions_container
			)
		);

		$page_transition_preloader_container = holmes_mkdf_add_admin_container(
			array(
				'parent'     => $page_transitions_container,
				'name'       => 'page_transition_preloader_container',
				'dependency' => array(
					'show' => array(
						'page_transition_preloader' => 'yes'
					)
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'   => 'smooth_pt_bgnd_color',
				'type'   => 'color',
				'label'  => esc_html__( 'Page Loader Background Color', 'holmes' ),
				'parent' => $page_transition_preloader_container
			)
		);

		$group_pt_spinner_animation = holmes_mkdf_add_admin_group(
			array(
				'name'        => 'group_pt_spinner_animation',
				'title'       => esc_html__( 'Loader Style', 'holmes' ),
				'description' => esc_html__( 'Define styles for loader spinner animation', 'holmes' ),
				'parent'      => $page_transition_preloader_container
			)
		);

		$row_pt_spinner_animation = holmes_mkdf_add_admin_row(
			array(
				'name'   => 'row_pt_spinner_animation',
				'parent' => $group_pt_spinner_animation
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'selectsimple',
				'name'          => 'smooth_pt_spinner_type',
				'default_value' => '',
				'label'         => esc_html__( 'Spinner Type', 'holmes' ),
				'parent'        => $row_pt_spinner_animation,
				'options'       => array(
					'rotate_circles'        => esc_html__( 'Rotate Circles', 'holmes' ),
					'pulse'                 => esc_html__( 'Pulse', 'holmes' ),
					'double_pulse'          => esc_html__( 'Double Pulse', 'holmes' ),
					'cube'                  => esc_html__( 'Cube', 'holmes' ),
					'rotating_cubes'        => esc_html__( 'Rotating Cubes', 'holmes' ),
					'stripes'               => esc_html__( 'Stripes', 'holmes' ),
					'wave'                  => esc_html__( 'Wave', 'holmes' ),
					'two_rotating_circles'  => esc_html__( '2 Rotating Circles', 'holmes' ),
					'five_rotating_circles' => esc_html__( '5 Rotating Circles', 'holmes' ),
					'atom'                  => esc_html__( 'Atom', 'holmes' ),
					'clock'                 => esc_html__( 'Clock', 'holmes' ),
					'mitosis'               => esc_html__( 'Mitosis', 'holmes' ),
					'lines'                 => esc_html__( 'Lines', 'holmes' ),
					'fussion'               => esc_html__( 'Fussion', 'holmes' ),
					'wave_circles'          => esc_html__( 'Wave Circles', 'holmes' ),
					'pulse_circles'         => esc_html__( 'Pulse Circles', 'holmes' )
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'colorsimple',
				'name'          => 'smooth_pt_spinner_color',
				'default_value' => '',
				'label'         => esc_html__( 'Spinner Color', 'holmes' ),
				'parent'        => $row_pt_spinner_animation
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'page_transition_fadeout',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Fade Out Animation', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'holmes' ),
				'parent'        => $page_transitions_container
			)
		);

		/***************** Smooth Page Transitions Layout - end **********************/

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'show_back_button',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show "Back To Top Button"', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will display a Back to Top button on every page', 'holmes' ),
				'parent'        => $panel_settings
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'responsiveness',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Responsiveness', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will make all pages responsive', 'holmes' ),
				'parent'        => $panel_settings
			)
		);

		$panel_custom_code = holmes_mkdf_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_custom_code',
				'title' => esc_html__( 'Custom Code', 'holmes' )
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'        => 'custom_js',
				'type'        => 'textarea',
				'label'       => esc_html__( 'Custom JS', 'holmes' ),
				'description' => esc_html__( 'Enter your custom Javascript here', 'holmes' ),
				'parent'      => $panel_custom_code
			)
		);

		$panel_google_api = holmes_mkdf_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_google_api',
				'title' => esc_html__( 'Google API', 'holmes' )
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'        => 'google_maps_api_key',
				'type'        => 'text',
				'label'       => esc_html__( 'Google Maps Api Key', 'holmes' ),
				'description' => esc_html__( 'Insert your Google Maps API key here. For instructions on how to create a Google Maps API key, please refer to our to our documentation.', 'holmes' ),
				'parent'      => $panel_google_api
			)
		);
	}

	add_action( 'holmes_mkdf_options_map', 'holmes_mkdf_general_options_map', holmes_mkdf_set_options_map_position( 'general' ) );
}

if ( ! function_exists( 'holmes_mkdf_page_general_style' ) ) {
	/**
	 * Function that prints page general inline styles
	 */
	function holmes_mkdf_page_general_style( $style ) {
		$current_style = '';
		$page_id       = holmes_mkdf_get_page_id();
		$class_prefix  = holmes_mkdf_get_unique_page_class( $page_id );

		$boxed_background_style = array();

		$boxed_page_background_color = holmes_mkdf_get_meta_field_intersect( 'page_background_color_in_box', $page_id );
		if ( ! empty( $boxed_page_background_color ) ) {
			$boxed_background_style['background-color'] = $boxed_page_background_color;
		}

		$boxed_page_background_image = holmes_mkdf_get_meta_field_intersect( 'boxed_background_image', $page_id );
		if ( ! empty( $boxed_page_background_image ) ) {
			$boxed_background_style['background-image']    = 'url(' . esc_url( $boxed_page_background_image ) . ')';
			$boxed_background_style['background-position'] = 'center 0px';
			$boxed_background_style['background-repeat']   = 'no-repeat';
		}

		$boxed_page_background_pattern_image = holmes_mkdf_get_meta_field_intersect( 'boxed_pattern_background_image', $page_id );
		if ( ! empty( $boxed_page_background_pattern_image ) ) {
			$boxed_background_style['background-image']    = 'url(' . esc_url( $boxed_page_background_pattern_image ) . ')';
			$boxed_background_style['background-position'] = '0px 0px';
			$boxed_background_style['background-repeat']   = 'repeat';
		}

		$boxed_page_background_attachment = holmes_mkdf_get_meta_field_intersect( 'boxed_background_image_attachment', $page_id );
		if ( ! empty( $boxed_page_background_attachment ) ) {
			$boxed_background_style['background-attachment'] = $boxed_page_background_attachment;
		}

		$boxed_background_selector = $class_prefix . '.mkdf-boxed .mkdf-wrapper';

		if ( ! empty( $boxed_background_style ) ) {
			$current_style .= holmes_mkdf_dynamic_css( $boxed_background_selector, $boxed_background_style );
		}

		$paspartu_style     = array();
		$paspartu_res_style = array();
		$paspartu_res_start = '@media only screen and (max-width: 1024px) {';
		$paspartu_res_end   = '}';

		$paspartu_header_selector        = array(
			'.mkdf-paspartu-enabled .mkdf-page-header .mkdf-fixed-wrapper.fixed',
			'.mkdf-paspartu-enabled .mkdf-sticky-header',
			'.mkdf-paspartu-enabled .mkdf-mobile-header.mobile-header-appear .mkdf-mobile-header-inner'
		);
		$paspartu_header_appear_selector = array(
			'.mkdf-paspartu-enabled.mkdf-fixed-paspartu-enabled .mkdf-page-header .mkdf-fixed-wrapper.fixed',
			'.mkdf-paspartu-enabled.mkdf-fixed-paspartu-enabled .mkdf-sticky-header.header-appear',
			'.mkdf-paspartu-enabled.mkdf-fixed-paspartu-enabled .mkdf-mobile-header.mobile-header-appear .mkdf-mobile-header-inner'
		);

		$paspartu_header_style                   = array();
		$paspartu_header_appear_style            = array();
		$paspartu_header_responsive_style        = array();
		$paspartu_header_appear_responsive_style = array();

		$paspartu_color = holmes_mkdf_get_meta_field_intersect( 'paspartu_color', $page_id );
		if ( ! empty( $paspartu_color ) ) {
			$paspartu_style['background-color'] = $paspartu_color;
		}

		$paspartu_width = holmes_mkdf_get_meta_field_intersect( 'paspartu_width', $page_id );
		if ( $paspartu_width !== '' ) {
			if ( holmes_mkdf_string_ends_with( $paspartu_width, '%' ) || holmes_mkdf_string_ends_with( $paspartu_width, 'px' ) ) {
				$paspartu_style['padding'] = $paspartu_width;

				$paspartu_clean_width      = holmes_mkdf_string_ends_with( $paspartu_width, '%' ) ? holmes_mkdf_filter_suffix( $paspartu_width, '%' ) : holmes_mkdf_filter_suffix( $paspartu_width, 'px' );
				$paspartu_clean_width_mark = holmes_mkdf_string_ends_with( $paspartu_width, '%' ) ? '%' : 'px';

				$paspartu_header_style['left']              = $paspartu_width;
				$paspartu_header_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_clean_width ) . $paspartu_clean_width_mark . ')';
				$paspartu_header_appear_style['margin-top'] = $paspartu_width;
				//
				$wide_dd_style['margin-left']  = $paspartu_width;
				$wide_dd_style['margin-right'] = $paspartu_width;
				//
			} else {
				$paspartu_style['padding'] = $paspartu_width . 'px';

				$paspartu_header_style['left']              = $paspartu_width . 'px';
				$paspartu_header_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_width ) . 'px)';
				$paspartu_header_appear_style['margin-top'] = $paspartu_width . 'px';
				//
				$wide_dd_style['margin-left']  = $paspartu_width . 'px';
				$wide_dd_style['margin-right'] = $paspartu_width . 'px';
				//
			}
		}

		$paspartu_selector = $class_prefix . '.mkdf-paspartu-enabled .mkdf-wrapper';
		$wide_dd_selector  = $class_prefix . ' .wide .inner';

		if ( ! empty( $paspartu_style ) ) {
			$current_style .= holmes_mkdf_dynamic_css( $paspartu_selector, $paspartu_style );
			$current_style .= holmes_mkdf_dynamic_css( $wide_dd_selector, $wide_dd_style );
		}

		if ( ! empty( $paspartu_header_style ) ) {
			$current_style .= holmes_mkdf_dynamic_css( $paspartu_header_selector, $paspartu_header_style );
			$current_style .= holmes_mkdf_dynamic_css( $paspartu_header_appear_selector, $paspartu_header_appear_style );
		}

		$paspartu_responsive_width = holmes_mkdf_get_meta_field_intersect( 'paspartu_responsive_width', $page_id );
		if ( $paspartu_responsive_width !== '' ) {
			if ( holmes_mkdf_string_ends_with( $paspartu_responsive_width, '%' ) || holmes_mkdf_string_ends_with( $paspartu_responsive_width, 'px' ) ) {
				$paspartu_res_style['padding'] = $paspartu_responsive_width;

				$paspartu_clean_width      = holmes_mkdf_string_ends_with( $paspartu_responsive_width, '%' ) ? holmes_mkdf_filter_suffix( $paspartu_responsive_width, '%' ) : holmes_mkdf_filter_suffix( $paspartu_responsive_width, 'px' );
				$paspartu_clean_width_mark = holmes_mkdf_string_ends_with( $paspartu_responsive_width, '%' ) ? '%' : 'px';

				$paspartu_header_responsive_style['left']              = $paspartu_responsive_width;
				$paspartu_header_responsive_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_clean_width ) . $paspartu_clean_width_mark . ')';
				$paspartu_header_appear_responsive_style['margin-top'] = $paspartu_responsive_width;
			} else {
				$paspartu_res_style['padding'] = $paspartu_responsive_width . 'px';

				$paspartu_header_responsive_style['left']              = $paspartu_responsive_width . 'px';
				$paspartu_header_responsive_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_responsive_width ) . 'px)';
				$paspartu_header_appear_responsive_style['margin-top'] = $paspartu_responsive_width . 'px';
			}
		}

		if ( ! empty( $paspartu_res_style ) ) {
			$current_style .= $paspartu_res_start . holmes_mkdf_dynamic_css( $paspartu_selector, $paspartu_res_style ) . $paspartu_res_end;
		}

		if ( ! empty( $paspartu_header_responsive_style ) ) {
			$current_style .= $paspartu_res_start . holmes_mkdf_dynamic_css( $paspartu_header_selector, $paspartu_header_responsive_style ) . $paspartu_res_end;
			$current_style .= $paspartu_res_start . holmes_mkdf_dynamic_css( $paspartu_header_appear_selector, $paspartu_header_appear_responsive_style ) . $paspartu_res_end;
		}

		$current_style = $current_style . $style;

		return $current_style;
	}

	add_filter( 'holmes_mkdf_add_page_custom_style', 'holmes_mkdf_page_general_style' );
}
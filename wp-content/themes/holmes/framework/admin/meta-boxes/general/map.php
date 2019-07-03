<?php

if ( ! function_exists( 'holmes_mkdf_map_general_meta' ) ) {
	function holmes_mkdf_map_general_meta() {

		$general_meta_box = holmes_mkdf_create_meta_box(
			array(
				'scope' => apply_filters( 'holmes_mkdf_set_scope_for_meta_boxes', array(
					'page',
					'post'
				), 'general_meta' ),
				'title' => esc_html__( 'General', 'holmes' ),
				'name'  => 'general_meta'
			)
		);

		/***************** Slider Layout - begin **********************/

		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_page_slider_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Slider Shortcode', 'holmes' ),
				'description' => esc_html__( 'Paste your slider shortcode here', 'holmes' ),
				'parent'      => $general_meta_box
			)
		);

		/***************** Slider Layout - begin **********************/

		/***************** Content Layout - begin **********************/

		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_page_content_behind_header_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Always put content behind header', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will put page content behind page header', 'holmes' ),
				'parent'        => $general_meta_box
			)
		);

		$mkdf_content_padding_group = holmes_mkdf_add_admin_group(
			array(
				'name'        => 'content_padding_group',
				'title'       => esc_html__( 'Content Styles', 'holmes' ),
				'description' => esc_html__( 'Define styles for Content area', 'holmes' ),
				'parent'      => $general_meta_box
			)
		);

		$mkdf_content_padding_row = holmes_mkdf_add_admin_row(
			array(
				'name'   => 'mkdf_content_padding_row',
				'parent' => $mkdf_content_padding_group
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'name'   => 'mkdf_page_background_color_meta',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Page Background Color', 'holmes' ),
				'parent' => $mkdf_content_padding_row
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'name'   => 'mkdf_page_background_image_meta',
				'type'   => 'imagesimple',
				'label'  => esc_html__( 'Page Background Image', 'holmes' ),
				'parent' => $mkdf_content_padding_row
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_page_background_repeat_meta',
				'type'          => 'selectsimple',
				'default_value' => '',
				'label'         => esc_html__( 'Page Background Image Repeat', 'holmes' ),
				'options'       => holmes_mkdf_get_yes_no_select_array(),
				'parent'        => $mkdf_content_padding_row
			)
		);

		$mkdf_content_padding_row_1 = holmes_mkdf_add_admin_row(
			array(
				'name'   => 'mkdf_content_padding_row_1',
				'next'   => true,
				'parent' => $mkdf_content_padding_group
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'name'   => 'mkdf_page_content_padding',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Content Padding (eg. 10px 5px 10px 5px)', 'holmes' ),
				'parent' => $mkdf_content_padding_row_1,
				'args'   => array(
					'col_width' => 4
				)
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'name'   => 'mkdf_page_content_padding_mobile',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Content Padding for mobile (eg. 10px 5px 10px 5px)', 'holmes' ),
				'parent' => $mkdf_content_padding_row_1,
				'args'   => array(
					'col_width' => 4
				)
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_initial_content_width_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'holmes' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'holmes' ),
				'parent'        => $general_meta_box,
				'options'       => array(
					''               => esc_html__( 'Default', 'holmes' ),
					'mkdf-grid-1300' => esc_html__( '1300px', 'holmes' ),
					'mkdf-grid-1200' => esc_html__( '1200px', 'holmes' ),
					'mkdf-grid-1100' => esc_html__( '1100px', 'holmes' ),
					'mkdf-grid-1000' => esc_html__( '1000px', 'holmes' ),
					'mkdf-grid-800'  => esc_html__( '800px', 'holmes' )
				)
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_page_grid_space_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Grid Layout Space', 'holmes' ),
				'description'   => esc_html__( 'Choose a space between content layout and sidebar layout for your page', 'holmes' ),
				'options'       => holmes_mkdf_get_space_between_items_array( true ),
				'parent'        => $general_meta_box
			)
		);

		/***************** Content Layout - end **********************/

		/***************** Boxed Layout - begin **********************/

		holmes_mkdf_create_meta_box_field(
			array(
				'name'    => 'mkdf_boxed_meta',
				'type'    => 'select',
				'label'   => esc_html__( 'Boxed Layout', 'holmes' ),
				'parent'  => $general_meta_box,
				'options' => holmes_mkdf_get_yes_no_select_array()
			)
		);

		$boxed_container_meta = holmes_mkdf_add_admin_container(
			array(
				'parent'     => $general_meta_box,
				'name'       => 'boxed_container_meta',
				'dependency' => array(
					'hide' => array(
						'mkdf_boxed_meta' => array( '', 'no' )
					)
				)
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_page_background_color_in_box_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Page Background Color', 'holmes' ),
				'description' => esc_html__( 'Choose the page background color outside box', 'holmes' ),
				'parent'      => $boxed_container_meta
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_boxed_background_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Background Image', 'holmes' ),
				'description' => esc_html__( 'Choose an image to be displayed in background', 'holmes' ),
				'parent'      => $boxed_container_meta
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_boxed_pattern_background_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Background Pattern', 'holmes' ),
				'description' => esc_html__( 'Choose an image to be used as background pattern', 'holmes' ),
				'parent'      => $boxed_container_meta
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_boxed_background_image_attachment_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Background Image Attachment', 'holmes' ),
				'description'   => esc_html__( 'Choose background image attachment', 'holmes' ),
				'parent'        => $boxed_container_meta,
				'options'       => array(
					''       => esc_html__( 'Default', 'holmes' ),
					'fixed'  => esc_html__( 'Fixed', 'holmes' ),
					'scroll' => esc_html__( 'Scroll', 'holmes' )
				)
			)
		);

		/***************** Boxed Layout - end **********************/

		/***************** Passepartout Layout - begin **********************/

		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_paspartu_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Passepartout', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'holmes' ),
				'parent'        => $general_meta_box,
				'options'       => holmes_mkdf_get_yes_no_select_array(),
			)
		);

		$paspartu_container_meta = holmes_mkdf_add_admin_container(
			array(
				'parent'     => $general_meta_box,
				'name'       => 'mkdf_paspartu_container_meta',
				'dependency' => array(
					'hide' => array(
						'mkdf_paspartu_meta' => array( '', 'no' )
					)
				)
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_paspartu_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Passepartout Color', 'holmes' ),
				'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'holmes' ),
				'parent'      => $paspartu_container_meta
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_paspartu_width_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Passepartout Size', 'holmes' ),
				'description' => esc_html__( 'Enter size amount for passepartout', 'holmes' ),
				'parent'      => $paspartu_container_meta,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px or %'
				)
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_paspartu_responsive_width_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Responsive Passepartout Size', 'holmes' ),
				'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (tablets and mobiles view)', 'holmes' ),
				'parent'      => $paspartu_container_meta,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px or %'
				)
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'parent'        => $paspartu_container_meta,
				'type'          => 'select',
				'default_value' => '',
				'name'          => 'mkdf_disable_top_paspartu_meta',
				'label'         => esc_html__( 'Disable Top Passepartout', 'holmes' ),
				'options'       => holmes_mkdf_get_yes_no_select_array(),
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'parent'        => $paspartu_container_meta,
				'type'          => 'select',
				'default_value' => '',
				'name'          => 'mkdf_enable_fixed_paspartu_meta',
				'label'         => esc_html__( 'Enable Fixed Passepartout', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will set fixed passepartout for your screens', 'holmes' ),
				'options'       => holmes_mkdf_get_yes_no_select_array(),
			)
		);

		/***************** Passepartout Layout - end **********************/

		/***************** Smooth Page Transitions Layout - begin **********************/

		holmes_mkdf_create_meta_box_field(
			array(
				'name'          => 'mkdf_smooth_page_transitions_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Smooth Page Transitions', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'holmes' ),
				'parent'        => $general_meta_box,
				'options'       => holmes_mkdf_get_yes_no_select_array()
			)
		);

		$page_transitions_container_meta = holmes_mkdf_add_admin_container(
			array(
				'parent'     => $general_meta_box,
				'name'       => 'page_transitions_container_meta',
				'dependency' => array(
					'hide' => array(
						'mkdf_smooth_page_transitions_meta' => array( '', 'no' )
					)
				)
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_page_transition_preloader_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Enable Preloading Animation', 'holmes' ),
				'description' => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'holmes' ),
				'parent'      => $page_transitions_container_meta,
				'options'     => holmes_mkdf_get_yes_no_select_array()
			)
		);

		$page_transition_preloader_container_meta = holmes_mkdf_add_admin_container(
			array(
				'parent'     => $page_transitions_container_meta,
				'name'       => 'page_transition_preloader_container_meta',
				'dependency' => array(
					'hide' => array(
						'mkdf_page_transition_preloader_meta' => array( '', 'no' )
					)
				)
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'name'   => 'mkdf_smooth_pt_bgnd_color_meta',
				'type'   => 'color',
				'label'  => esc_html__( 'Page Loader Background Color', 'holmes' ),
				'parent' => $page_transition_preloader_container_meta
			)
		);

		$group_pt_spinner_animation_meta = holmes_mkdf_add_admin_group(
			array(
				'name'        => 'group_pt_spinner_animation_meta',
				'title'       => esc_html__( 'Loader Style', 'holmes' ),
				'description' => esc_html__( 'Define styles for loader spinner animation', 'holmes' ),
				'parent'      => $page_transition_preloader_container_meta
			)
		);

		$row_pt_spinner_animation_meta = holmes_mkdf_add_admin_row(
			array(
				'name'   => 'row_pt_spinner_animation_meta',
				'parent' => $group_pt_spinner_animation_meta
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'type'    => 'selectsimple',
				'name'    => 'mkdf_smooth_pt_spinner_type_meta',
				'label'   => esc_html__( 'Spinner Type', 'holmes' ),
				'parent'  => $row_pt_spinner_animation_meta,
				'options' => array(
					''                      => esc_html__( 'Default', 'holmes' ),
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

		holmes_mkdf_create_meta_box_field(
			array(
				'type'   => 'colorsimple',
				'name'   => 'mkdf_smooth_pt_spinner_color_meta',
				'label'  => esc_html__( 'Spinner Color', 'holmes' ),
				'parent' => $row_pt_spinner_animation_meta
			)
		);

		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_page_transition_fadeout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Enable Fade Out Animation', 'holmes' ),
				'description' => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'holmes' ),
				'options'     => holmes_mkdf_get_yes_no_select_array(),
				'parent'      => $page_transitions_container_meta

			)
		);

		/***************** Smooth Page Transitions Layout - end **********************/

		/***************** Comments Layout - begin **********************/

		holmes_mkdf_create_meta_box_field(
			array(
				'name'        => 'mkdf_page_comments_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Show Comments', 'holmes' ),
				'description' => esc_html__( 'Enabling this option will show comments on your page', 'holmes' ),
				'parent'      => $general_meta_box,
				'options'     => holmes_mkdf_get_yes_no_select_array()
			)
		);

		/***************** Comments Layout - end **********************/
	}

	add_action( 'holmes_mkdf_meta_boxes_map', 'holmes_mkdf_map_general_meta', 10 );
}

if ( ! function_exists( 'holmes_mkdf_container_background_style' ) ) {
	/**
	 * Function that return container style
	 */
	function holmes_mkdf_container_background_style( $style ) {
		$page_id      = holmes_mkdf_get_page_id();
		$class_prefix = holmes_mkdf_get_unique_page_class( $page_id, true );

		$container_selector = array(
			$class_prefix . ' .mkdf-content'
		);

		$container_class        = array();
		$page_background_color  = get_post_meta( $page_id, 'mkdf_page_background_color_meta', true );
		$page_background_image  = get_post_meta( $page_id, 'mkdf_page_background_image_meta', true );
		$page_background_repeat = get_post_meta( $page_id, 'mkdf_page_background_repeat_meta', true );

		if ( ! empty( $page_background_color ) ) {
			$container_class['background-color'] = $page_background_color;
		}

		if ( ! empty( $page_background_image ) ) {
			$container_class['background-image'] = 'url(' . esc_url( $page_background_image ) . ')';

			if ( $page_background_repeat === 'yes' ) {
				$container_class['background-repeat']   = 'repeat';
				$container_class['background-position'] = 'center 0';
			} else {
				$container_class['background-repeat']   = 'no-repeat';
				$container_class['background-position'] = 'center 0';
				$container_class['background-size']     = 'cover';
			}
		}

		$current_style = holmes_mkdf_dynamic_css( $container_selector, $container_class );
		$current_style = $current_style . $style;

		return $current_style;
	}

	add_filter( 'holmes_mkdf_add_page_custom_style', 'holmes_mkdf_container_background_style' );
}
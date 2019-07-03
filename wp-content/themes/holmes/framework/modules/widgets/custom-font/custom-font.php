<?php

class HolmesMkdfCustomFontWidget extends HolmesMkdfWidget {
	public function __construct() {
		parent::__construct(
			'mkdf_custom_font_widget',
			esc_html__( 'Holmes Custom Font Widget', 'holmes' ),
			array( 'description' => esc_html__( 'Add custom font element to widget areas', 'holmes' ) )
		);

		$this->setParams();
	}

	protected function setParams() {
		$this->params = array(
			array(
				'type'        => 'textfield',
				'name'        => 'custom_class',
				'title'       => esc_html__( 'Custom CSS Class', 'holmes' ),
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'holmes' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'link',
				'title' => esc_html__( 'Link', 'holmes' ),
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'link_target',
				'title'   => esc_html__( 'Open Link in', 'holmes' ),
				'options' => array(
					'_blank' => esc_html__( 'New Window', 'holmes' ),
					'_self'  => esc_html__( 'Current Window', 'holmes' ),
				),
			),
			array(
				'type'  => 'textfield',
				'name'  => 'title',
				'title' => esc_html__( 'Title Text', 'holmes' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'title_tag',
				'title'   => esc_html__( 'Title Tag', 'holmes' ),
				'options' => holmes_mkdf_get_title_tag( true, array( 'p' => 'p' ) )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'font_family',
				'title' => esc_html__( 'Font Family', 'holmes' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'font_size',
				'title' => esc_html__( 'Font Size (px or em)', 'holmes' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'line_height',
				'title' => esc_html__( 'Line Height (px or em)', 'holmes' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'font_weight',
				'title'   => esc_html__( 'Font Weight', 'holmes' ),
				'options' => holmes_mkdf_get_font_weight_array( true )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'font_style',
				'title'   => esc_html__( 'Font Style', 'holmes' ),
				'options' => holmes_mkdf_get_font_style_array( true )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'letter_spacing',
				'title' => esc_html__( 'Letter Spacing (px or em)', 'holmes' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'text_transform',
				'title'   => esc_html__( 'Text Transform', 'holmes' ),
				'options' => holmes_mkdf_get_text_transform_array( true )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'text_decoration',
				'title'   => esc_html__( 'Text Decoration', 'holmes' ),
				'options' => holmes_mkdf_get_text_decorations( true )
			),
			//array(
			//	'type'  => 'colorpicker',
			//	'name'  => 'color',
			//	'title' => esc_html__( 'Color', 'holmes' )
			//),
			array(
				'type'    => 'dropdown',
				'name'    => 'text_align',
				'title'   => esc_html__( 'Text Align', 'holmes' ),
				'options' => array(
					''        => esc_html__( 'Default', 'holmes' ),
					'left'    => esc_html__( 'Left', 'holmes' ),
					'center'  => esc_html__( 'Center', 'holmes' ),
					'right'   => esc_html__( 'Right', 'holmes' ),
					'justify' => esc_html__( 'Justify', 'holmes' )
				)
			),
			array(
				'type'        => 'textfield',
				'name'        => 'margin',
				'title'       => esc_html__( 'Margin (px or %)', 'holmes' ),
				'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'holmes' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'font_size_1366',
				'title' => esc_html__( 'Laptops Font Size (px or em)', 'holmes' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'line_height_1366',
				'title' => esc_html__( 'Laptops Line Height (px or em)', 'holmes' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'font_size_1024',
				'title' => esc_html__( 'Tablets Landscape Font Size (px or em)', 'holmes' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'line_height_1024',
				'title' => esc_html__( 'Tablets Landscape Line Height (px or em)', 'holmes' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'font_size_768',
				'title' => esc_html__( 'Tablets Portrait Font Size (px or em)', 'holmes' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'line_height_768',
				'title' => esc_html__( 'Tablets Portrait Line Height (px or em)', 'holmes' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'font_size_680',
				'title' => esc_html__( 'Mobiles Font Size (px or em)', 'holmes' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'line_height_680',
				'title' => esc_html__( 'Mobiles Line Height (px or em)', 'holmes' )
			)
		);
	}

	public function widget( $args, $instance ) {
		$params = '';

		if ( ! is_array( $instance ) ) {
			$instance = array();
		}

		// Filter out all empty params
		$instance = array_filter( $instance, function ( $array_value ) {
			return trim( $array_value ) != '';
		} );

		// Generate shortcode params
		foreach ( $instance as $key => $value ) {
			$params .= " $key='$value' ";
		}

		echo '<div class="widget mkdf-custom-font-widget">';
		if ( ! empty( $instance['link'] ) ):
			echo '<a href="' . esc_attr( $instance['link'] ) . '" target="' . esc_attr( $instance['link_target'] ) . '">';
		endif;
		echo do_shortcode( "[mkdf_custom_font $params]" ); // XSS OK
		if ( ! empty( $instance['link'] ) ):
			echo '</a>';
		endif;
		echo '</div>';
	}
}
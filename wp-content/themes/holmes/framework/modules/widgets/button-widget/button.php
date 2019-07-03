<?php

class HolmesMkdfButtonWidget extends HolmesMkdfWidget {
	public function __construct() {
		parent::__construct(
			'mkdf_button_widget',
			esc_html__( 'Holmes Button Widget', 'holmes' ),
			array( 'description' => esc_html__( 'Add button element to widget areas', 'holmes' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'    => 'dropdown',
				'name'    => 'type',
				'title'   => esc_html__( 'Type', 'holmes' ),
				'options' => array(
					'solid'   => esc_html__( 'Solid', 'holmes' ),
					'outline' => esc_html__( 'Outline', 'holmes' ),
					'simple'  => esc_html__( 'Simple', 'holmes' )
				)
			),
			array(
				'type'        => 'dropdown',
				'name'        => 'size',
				'title'       => esc_html__( 'Size', 'holmes' ),
				'options'     => array(
					'small'  => esc_html__( 'Small', 'holmes' ),
					'medium' => esc_html__( 'Medium', 'holmes' ),
					'large'  => esc_html__( 'Large', 'holmes' ),
					'huge'   => esc_html__( 'Huge', 'holmes' )
				),
				'description' => esc_html__( 'This option is only available for solid and outline button type', 'holmes' )
			),
			array(
				'type'    => 'textfield',
				'name'    => 'text',
				'title'   => esc_html__( 'Text', 'holmes' ),
				'default' => esc_html__( 'Button Text', 'holmes' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'link',
				'title' => esc_html__( 'Link', 'holmes' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'target',
				'title'   => esc_html__( 'Link Target', 'holmes' ),
				'options' => holmes_mkdf_get_link_target_array()
			),
			array(
				'type'  => 'colorpicker',
				'name'  => 'color',
				'title' => esc_html__( 'Color', 'holmes' )
			),
			array(
				'type'  => 'colorpicker',
				'name'  => 'hover_color',
				'title' => esc_html__( 'Hover Color', 'holmes' )
			),
			array(
				'type'        => 'colorpicker',
				'name'        => 'background_color',
				'title'       => esc_html__( 'Background Color', 'holmes' ),
				'description' => esc_html__( 'This option is only available for solid button type', 'holmes' )
			),
			array(
				'type'        => 'colorpicker',
				'name'        => 'hover_background_color',
				'title'       => esc_html__( 'Hover Background Color', 'holmes' ),
				'description' => esc_html__( 'This option is only available for solid button type', 'holmes' )
			),
			array(
				'type'        => 'colorpicker',
				'name'        => 'border_color',
				'title'       => esc_html__( 'Border Color', 'holmes' ),
				'description' => esc_html__( 'This option is only available for solid and outline button type', 'holmes' )
			),
			array(
				'type'        => 'colorpicker',
				'name'        => 'hover_border_color',
				'title'       => esc_html__( 'Hover Border Color', 'holmes' ),
				'description' => esc_html__( 'This option is only available for solid and outline button type', 'holmes' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'margin',
				'title'       => esc_html__( 'Margin', 'holmes' ),
				'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'holmes' )
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
		
		// Default values
		if ( ! isset( $instance['text'] ) ) {
			$instance['text'] = 'Button Text';
		}
		
		// Generate shortcode params
		foreach ( $instance as $key => $value ) {
			$params .= " $key='$value' ";
		}
		
		echo '<div class="widget mkdf-button-widget">';
			echo do_shortcode( "[mkdf_button $params]" ); // XSS OK
		echo '</div>';
	}
}
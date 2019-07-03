<?php

class HolmesMkdfSeparatorWidget extends HolmesMkdfWidget {
	public function __construct() {
		parent::__construct(
			'mkdf_separator_widget',
			esc_html__( 'Holmes Separator Widget', 'holmes' ),
			array( 'description' => esc_html__( 'Add a separator element to your widget areas', 'holmes' ) )
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
					'normal'     => esc_html__( 'Normal', 'holmes' ),
					'full-width' => esc_html__( 'Full Width', 'holmes' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'position',
				'title'   => esc_html__( 'Position', 'holmes' ),
				'options' => array(
					'center' => esc_html__( 'Center', 'holmes' ),
					'left'   => esc_html__( 'Left', 'holmes' ),
					'right'  => esc_html__( 'Right', 'holmes' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'border_style',
				'title'   => esc_html__( 'Style', 'holmes' ),
				'options' => array(
					'solid'  => esc_html__( 'Solid', 'holmes' ),
					'dashed' => esc_html__( 'Dashed', 'holmes' ),
					'dotted' => esc_html__( 'Dotted', 'holmes' )
				)
			),
			array(
				'type'  => 'colorpicker',
				'name'  => 'color',
				'title' => esc_html__( 'Color', 'holmes' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'width',
				'title' => esc_html__( 'Width (px or %)', 'holmes' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'thickness',
				'title' => esc_html__( 'Thickness (px)', 'holmes' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'top_margin',
				'title' => esc_html__( 'Top Margin (px or %)', 'holmes' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'bottom_margin',
				'title' => esc_html__( 'Bottom Margin (px or %)', 'holmes' )
			)
		);
	}
	
	public function widget( $args, $instance ) {
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}
		
		//prepare variables
		$params = '';
		
		//is instance empty?
		if ( is_array( $instance ) && count( $instance ) ) {
			//generate shortcode params
			foreach ( $instance as $key => $value ) {
				$params .= " $key='$value' ";
			}
		}
		
		echo '<div class="widget mkdf-separator-widget">';
			echo do_shortcode( "[mkdf_separator $params]" ); // XSS OK
		echo '</div>';
	}
}
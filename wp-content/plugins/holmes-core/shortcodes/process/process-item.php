<?php

namespace HolmesCore\CPT\Shortcodes\Process;

use HolmesCore\Lib;

class ProcessItem implements Lib\ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'mkdf_process_item';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'     => esc_html__( 'Process Item', 'holmes-core' ),
					'base'     => $this->base,
					'category' => esc_html__( 'by HOLMES', 'holmes-core' ),
					'icon'     => 'icon-wpb-process-item extended-custom-icon',
					'as_child' => array( 'only' => 'mkdf_process' ),
					'params'   => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'holmes-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'holmes-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'layout',
							'heading'     => esc_html__( 'Layout', 'holmes-core' ),
							'value'       => array(
								esc_html__( 'Top Left', 'holmes-core' )    => 'top',
								esc_html__( 'Bottom Left', 'holmes-core' ) => 'bottom',
							),
							'save_always' => true,
						),
						array(
							'type'       => 'attach_image',
							'param_name' => 'image',
							'heading'    => esc_html__( 'Image', 'holmes-core' ),
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'number',
							'heading'    => esc_html__( 'Number', 'holmes-core' ),
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'title',
							'heading'    => esc_html__( 'Title', 'holmes-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'title_tag',
							'heading'     => esc_html__( 'Title Tag', 'holmes-core' ),
							'value'       => array_flip( holmes_mkdf_get_title_tag( true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'title', 'not_empty' => true )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'title_color',
							'heading'    => esc_html__( 'Title Color', 'holmes-core' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true )
						),
						array(
							'type'       => 'textarea',
							'param_name' => 'text',
							'heading'    => esc_html__( 'Text', 'holmes-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'text_color',
							'heading'    => esc_html__( 'Text Color', 'holmes-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true )
						),
					)
				)
			);
		}
	}

	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class' => '',
			'title'        => '',
			'title_tag'    => 'h2',
			'title_color'  => '',
			'image'        => '',
			'number'       => '',
			'text'         => '',
			'text_color'   => '',
			'layout'       => '',
		);
		$params = shortcode_atts( $args, $atts );

		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['title_tag']      = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		$params['title_styles']   = $this->getTitleStyles( $params );
		$params['text_styles']    = $this->getTextStyles( $params );

		$html = holmes_core_get_shortcode_module_template_part( 'templates/process-item-template', 'process', '', $params );

		return $html;
	}

	private function getHolderClasses( $params ) {
		$holderClasses = array();

		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		if ( ! empty( $params['layout'] ) ) {
			$holderClasses[] = 'mkdf-' . $params['layout'];
		}

		return implode( ' ', $holderClasses );
	}

	private function getTitleStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}

		return implode( ';', $styles );
	}

	private function getTextStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['text_color'] ) ) {
			$styles[] = 'color: ' . $params['text_color'];
		}

		return implode( ';', $styles );
	}

}

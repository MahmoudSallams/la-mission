<?php

namespace HolmesCore\CPT\Shortcodes\CallToAction;

use HolmesCore\Lib;

class CallToAction implements Lib\ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'mkdf_call_to_action';

		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Call To Action', 'holmes-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by HOLMES', 'holmes-core' ),
					'icon'                      => 'icon-wpb-call-to-action extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'holmes-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'holmes-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'color',
							'heading'    => esc_html__( 'Color', 'holmes-core' ),
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'background_color',
							'heading'    => esc_html__( 'Background Color', 'holmes-core' ),
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'button_link',
							'heading'    => esc_html__( 'Button Link', 'holmes-core' ),
						),
						array(
							'type'        => 'checkbox',
							'param_name'  => 'new_window',
							'heading'     => esc_html__( 'New Window', 'holmes-core' ),
							'value'       => 'true',
							'description' => esc_html__( 'Open link in new window on click', 'holmes-core' ),
						),
						array(
							'type'       => 'textarea_html',
							'param_name' => 'content',
							'heading'    => esc_html__( 'Content', 'holmes-core' ),
							'value'      => esc_html__( 'I am test text for Call to Action shortcode content', 'holmes-core' )
						)
					)
				)
			);
		}
	}

	public function render( $atts, $content = null ) {
		$args = array(
			'custom_class'     => '',
			'color'            => '#000000',
			'background_color' => '#ffffff',
			'button_link'      => '',
			'new_window'       => '',
		);

		$params = shortcode_atts( $args, $atts );

		$params['content'] = preg_replace( '#^<\/p>|<p>$#', '', $content );

		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['text_styles']    = $this->getTextStyles( $params );
		$params['target']         = ( $params['new_window'] === 'true' ) ? '_blank' : '';

		$html = holmes_core_get_shortcode_module_template_part( 'templates/call-to-action', 'call-to-action', '', $params );

		return $html;
	}

	private function getHolderClasses( $params ) {
		$holderClasses = array();

		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';

		return implode( ' ', $holderClasses );
	}

	private function getTextStyles( $params ) {
		$styles = array();

		if ( $params['color'] !== '' ) {
			$styles[] = 'color:' . $params['color'];
		}

		if ( $params['background_color'] !== '' ) {
			$styles[] = 'background-color:' . $params['background_color'];
		}

		return implode( ';', $styles );
	}
}
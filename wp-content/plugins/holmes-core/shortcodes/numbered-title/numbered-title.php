<?php
namespace HolmesCore\CPT\Shortcodes\NumberedTitle;

use HolmesCore\Lib;

class NumberedTitle implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'mkdf_numbered_title';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Numbered Title', 'holmes-core' ),
					'base'                      => $this->getBase(),
					'icon'                      => 'icon-wpb-numbered-title extended-custom-icon',
					'category'                  => esc_html__( 'by HOLMES', 'holmes-core' ),
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'holmes-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'holmes-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'title',
							'heading'    => esc_html__( 'Title', 'holmes-core' )
						),
						array(
							'type'       => 'textarea',
							'param_name' => 'text',
							'heading'    => esc_html__( 'Text', 'holmes-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'color',
							'heading'    => esc_html__( 'Color', 'holmes-core' ),
						),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'line_width',
                            'heading'    => esc_html__( 'Line Width', 'holmes-core' ),
                            'description'=> esc_html__( 'Enter the width in px', 'holmes-core' )
                        )
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'   => '',
			'title'          => '',
			'text'           => '',
			'color'          => '',
			'line_width'     => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['text_style']    = $this->getTextStyles( $params );
		$params['line_style']    = $this->getLineStyles( $params );

		$html = holmes_core_get_shortcode_module_template_part( 'templates/numbered-title-template', 'numbered-title', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		
		return implode( ' ', $holderClasses );
	}

	private function getTextStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['color'] ) ) {
			$styles[] = 'color: ' . $params['color'];
		}
		
		return implode( ';', $styles );
	}

    private function getLineStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['color'] ) ) {
            $styles[] = 'background-color: ' . $params['color'];
        }

        if ( ! empty( $params['line_width'] ) ) {
            $styles[] = 'width: ' . holmes_mkdf_filter_px( $params['line_width'] ) . 'px';
        }

        return implode( ';', $styles );
    }
}
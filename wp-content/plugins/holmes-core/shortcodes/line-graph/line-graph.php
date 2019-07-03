<?php
namespace HolmesCore\CPT\Shortcodes\Linegraph;

use HolmesCore\Lib;

class LineGraph implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkdf_line_graph';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'     => esc_html__( 'Line Graph', 'holmes-core' ),
					'base'     => $this->base,
					'icon'     => 'icon-wpb-line-graph extended-custom-icon',
					'category' => esc_html__( 'by HOLMES', 'holmes-core' ),
					'params'   => array(
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'custom_class',
                            'heading'     => esc_html__( 'Custom CSS Class', 'holmes-core' ),
                            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'holmes-core' )
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'width',
                            'value'       => '750',
                            'heading'     => esc_html__( 'Width', 'holmes-core' ),
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'height',
                            'value'       => '350',
                            'heading'     => esc_html__( 'Height', 'holmes-core' ),
                        ),
                        array(
                            'type'        => 'colorpicker',
                            'param_name'  => 'custom_color',
                            'heading'     => esc_html__( 'Custom Color', 'holmes-core' ),
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'scale_steps',
                            'value'       => '6',
                            'heading'     => esc_html__( 'Scale Steps', 'holmes-core' ),
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'scale_steps_width',
                            'value'       => '20',
                            'heading'     => esc_html__( 'Scale Steps', 'holmes-core' ),
                        ),
                        array(
                            'type'       => 'param_group',
                            'param_name' => 'graph_items',
                            'heading'    => esc_html__( 'Graph Items', 'holmes-core' ),
                            'params'     => array(
                                array(
                                    'type'        => 'textfield',
                                    'param_name'  => 'label',
                                    'heading'     => esc_html__( 'Label', 'holmes-core' ),
                                ),
                                array(
                                    'type'        => 'colorpicker',
                                    'param_name'  => 'color',
                                    'heading'     => esc_html__( 'Color', 'holmes-core' ),
                                ),
                                array(
                                    'type'        => 'textfield',
                                    'param_name'  => 'legend_title',
                                    'heading'     => esc_html__( 'Legend Title', 'holmes-core' ),
                                ),
                                array(
                                    'type'        => 'textfield',
                                    'param_name'  => 'values',
                                    'heading'     => esc_html__( 'Values', 'holmes-core' ),
                                    'description' => esc_html__('Multiple values should be separated by commas')
                                ),
                            )
                        )
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
            'custom_class'  => '',
            'width' => '750',
            'height' => '350',
            'custom_color' => '',
            'scale_steps' => '6',
            'scale_steps_width' => '20',
            'graph_items' => ''
		);
		$params = shortcode_atts( $args, $atts );

		$params['holder_classes'] = $this->getHolderClasses( $params );

        $params['graph_items'] = json_decode( urldecode( $params['graph_items'] ), true );

		$html = holmes_core_get_shortcode_module_template_part( 'templates/line-graph-template', 'line-graph', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';

		return implode( ' ', $holderClasses );
	}
		
}
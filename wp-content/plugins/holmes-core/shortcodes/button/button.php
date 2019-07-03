<?php
namespace HolmesCore\CPT\Shortcodes\Button;

use HolmesCore\Lib;

class Button implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'mkdf_button';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Button', 'holmes-core' ),
					'base'                      => $this->base,
					'category'                  => esc_html__( 'by HOLMES', 'holmes-core' ),
					'icon'                      => 'icon-wpb-button extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'custom_class',
                            'heading'     => esc_html__( 'Custom CSS Class', 'holmes-core' ),
                            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'holmes-core' )
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'type',
                            'heading'     => esc_html__( 'Type', 'holmes-core' ),
                            'value'       => array(
                                esc_html__( 'Solid', 'holmes-core' )   => 'solid',
                                esc_html__( 'Outline', 'holmes-core' ) => 'outline',
                                esc_html__( 'Simple', 'holmes-core' )  => 'simple'
                            ),
                            'admin_label' => true
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'size',
                            'heading'    => esc_html__( 'Size', 'holmes-core' ),
                            'value'      => array(
                                esc_html__( 'Default', 'holmes-core' ) => '',
                                esc_html__( 'Small', 'holmes-core' )   => 'small',
                                esc_html__( 'Medium', 'holmes-core' )  => 'medium',
                                esc_html__( 'Large', 'holmes-core' )   => 'large',
                                esc_html__( 'Huge', 'holmes-core' )    => 'huge'
                            ),
                            'dependency' => array( 'element' => 'type', 'value' => array( 'solid', 'outline' ) )
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'text',
                            'heading'     => esc_html__( 'Text', 'holmes-core' ),
                            'value'       => esc_html__( 'Button Text', 'holmes-core' ),
                            'save_always' => true,
                            'admin_label' => true
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'description',
                            'heading'     => esc_html__( 'Description', 'holmes-core' ),
                            'save_always' => true,
                            'admin_label' => true
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'link',
                            'heading'    => esc_html__( 'Link', 'holmes-core' )
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'target',
                            'heading'     => esc_html__( 'Link Target', 'holmes-core' ),
                            'value'       => array_flip( holmes_mkdf_get_link_target_array() ),
                            'save_always' => true
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'color',
                            'heading'    => esc_html__( 'Color', 'holmes-core' ),
                            'group'      => esc_html__( 'Design Options', 'holmes-core' )
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'hover_color',
                            'heading'    => esc_html__( 'Hover Color', 'holmes-core' ),
                            'group'      => esc_html__( 'Design Options', 'holmes-core' )
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'background_color',
                            'heading'    => esc_html__( 'Background Color', 'holmes-core' ),
                            'dependency' => array( 'element' => 'type', 'value' => array( 'solid' ) ),
                            'group'      => esc_html__( 'Design Options', 'holmes-core' )
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'hover_background_color',
                            'heading'    => esc_html__( 'Hover Background Color', 'holmes-core' ),
                            'dependency' => array( 'element' => 'type', 'value' => array( 'solid', 'outline' ) ),
                            'group'      => esc_html__( 'Design Options', 'holmes-core' )
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'border_color',
                            'heading'    => esc_html__( 'Border Color', 'holmes-core' ),
                            'dependency' => array( 'element' => 'type', 'value' => array( 'solid', 'outline' ) ),
                            'group'      => esc_html__( 'Design Options', 'holmes-core' )
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'hover_border_color',
                            'heading'    => esc_html__( 'Hover Border Color', 'holmes-core' ),
                            'dependency' => array( 'element' => 'type', 'value' => array( 'solid', 'outline' ) ),
                            'group'      => esc_html__( 'Design Options', 'holmes-core' )
                        ),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_icon',
							'heading'     => esc_html__( 'Enable Icon', 'holmes-core' ),
							'value'       => array_flip( holmes_mkdf_get_yes_no_select_array() ),
							'save_always' => true
						),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'font_size',
                            'heading'    => esc_html__( 'Font Size (px)', 'holmes-core' ),
                            'group'      => esc_html__( 'Design Options', 'holmes-core' )
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'font_weight',
                            'heading'     => esc_html__( 'Font Weight', 'holmes-core' ),
                            'value'       => array_flip( holmes_mkdf_get_font_weight_array( true ) ),
                            'save_always' => true,
                            'group'       => esc_html__( 'Design Options', 'holmes-core' )
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'text_transform',
                            'heading'     => esc_html__( 'Text Transform', 'holmes-core' ),
                            'value'       => array_flip( holmes_mkdf_get_text_transform_array( true ) ),
                            'save_always' => true
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'margin',
                            'heading'     => esc_html__( 'Margin', 'holmes-core' ),
                            'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'holmes-core' ),
                            'group'       => esc_html__( 'Design Options', 'holmes-core' )
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'padding',
                            'heading'     => esc_html__( 'Button Padding', 'holmes-core' ),
                            'description' => esc_html__( 'Insert padding in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'holmes-core' ),
                            'dependency'  => array( 'element' => 'type', 'value' => array( 'solid', 'outline' ) ),
                            'group'       => esc_html__( 'Design Options', 'holmes-core' )
                        )
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'size'                   => '',
			'type'                   => 'solid',
			'text'                   => '',
			'description'            => '',
			'link'                   => '',
			'target'                 => '_self',
			'color'                  => '',
			'hover_color'            => '',
			'background_color'       => '',
			'hover_background_color' => '',
			'border_color'           => '',
			'hover_border_color'     => '',
			'enable_icon'            => 'no',
			'font_size'              => '',
			'font_weight'            => '',
			'text_transform'         => '',
			'margin'                 => '',
			'padding'                => '',
			'custom_class'           => '',
			'html_type'              => 'anchor',
			'input_name'             => '',
			'custom_attrs'           => array()
		);
		$params       = shortcode_atts( $default_atts, $atts );
		
		$params['size'] = ! empty( $params['size'] ) ? $params['size'] : 'medium';
		$params['type'] = ! empty( $params['type'] ) ? $params['type'] : 'solid';
		
		$params['link']   = ! empty( $params['link'] ) ? $params['link'] : '#';
		$params['target'] = ! empty( $params['target'] ) ? $params['target'] : $default_atts['target'];
		
		$params['button_classes']      = $this->getButtonClasses( $params );
		$params['button_custom_attrs'] = ! empty( $params['custom_attrs'] ) ? $params['custom_attrs'] : array();
		$params['button_styles']       = $this->getButtonStyles( $params );
		$params['button_data']         = $this->getButtonDataAttr( $params );
		
		return holmes_core_get_shortcode_module_template_part( 'templates/' . $params['html_type'], 'button', '', $params );
	}
	
	private function getButtonStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['color'] ) ) {
			$styles[] = 'color: ' . $params['color'];
		}
		
		if ( ! empty( $params['background_color'] ) && $params['type'] !== 'outline' ) {
			$styles[] = 'background-color: ' . $params['background_color'];
		}
		
		if ( ! empty( $params['border_color'] ) ) {
			$styles[] = 'border-color: ' . $params['border_color'];
		}
		
		if ( ! empty( $params['font_size'] ) ) {
			$styles[] = 'font-size: ' . holmes_mkdf_filter_px( $params['font_size'] ) . 'px';
		}
		
		if ( ! empty( $params['font_weight'] ) && $params['font_weight'] !== '' ) {
			$styles[] = 'font-weight: ' . $params['font_weight'];
		}
		
		if ( ! empty( $params['text_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['text_transform'];
		}
		
		if ( $params['margin'] !== '' ) {
			$styles[] = 'margin: ' . $params['margin'];
		}
		
		if ( $params['padding'] !== '' ) {
			$styles[] = 'padding: ' . $params['padding'];
		}
		
		return $styles;
	}
	
	private function getButtonDataAttr( $params ) {
		$data = array();
		
		if ( ! empty( $params['hover_color'] ) ) {
			$data['data-hover-color'] = $params['hover_color'];
		}
		
		if ( ! empty( $params['hover_background_color'] ) ) {
			$data['data-hover-bg-color'] = $params['hover_background_color'];
		}
		
		if ( ! empty( $params['hover_border_color'] ) ) {
			$data['data-hover-border-color'] = $params['hover_border_color'];
		}
		
		return $data;
	}
	
	private function getButtonClasses( $params ) {
		$buttonClasses = array(
			'mkdf-btn',
			'mkdf-btn-' . $params['size'],
			'mkdf-btn-' . $params['type']
		);

		if(empty($params['description'])){
            $buttonClasses[] = 'mkdf-btn-single-line';
        }

		if ( ! empty( $params['hover_background_color'] ) ) {
			$buttonClasses[] = 'mkdf-btn-custom-hover-bg';
		}
		
		if ( ! empty( $params['hover_border_color'] ) ) {
			$buttonClasses[] = 'mkdf-btn-custom-border-hover';
		}
		
		if ( ! empty( $params['hover_color'] ) ) {
			$buttonClasses[] = 'mkdf-btn-custom-hover-color';
		}
		
		if ( ! empty( $params['custom_class'] ) ) {
			$buttonClasses[] = esc_attr( $params['custom_class'] );
		}
		
		return $buttonClasses;
	}
}
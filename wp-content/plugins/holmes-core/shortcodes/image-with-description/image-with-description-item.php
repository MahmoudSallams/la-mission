<?php
namespace HolmesCore\CPT\Shortcodes\ImageWithDescription;

use HolmesCore\Lib;

class ImageWithDescriptionItem implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkdf_image_with_description_item';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Image With Text Item', 'holmes-core' ),
					'base'                      => $this->base,
					'icon'                      => 'icon-wpb-image-with-description-item extended-custom-icon',
					'category'                  => esc_html__( 'by HOLMES', 'holmes-core' ),
					'allowed_container_element' => 'vc_row',
					'as_child'                  => array( 'only' => 'mkdf_pricing_table' ),
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'holmes-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'holmes-core' )
						),
                        array(
                            'type'        => 'attach_image',
                            'param_name'  => 'image',
                            'heading'     => esc_html__('Image', 'holmes-core'),
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'link',
                            'heading'     => esc_html__('Link', 'holmes-core'),
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'title_1',
                            'heading'     => esc_html__('Title 1', 'holmes-core'),
                        ),
                        array(
                            'type'        => 'textarea',
                            'param_name'  => 'description_1',
                            'heading'     => esc_html__('Description 1', 'holmes-core'),
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'title_2',
                            'heading'     => esc_html__('Title 2', 'holmes-core'),
                        ),
                        array(
                            'type'        => 'textarea',
                            'param_name'  => 'description_2',
                            'heading'     => esc_html__('Description 2', 'holmes-core'),
                        ),
                    )
                )
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class' => '',
            'image' => '',
            'link'  => '',
            'title_1' => '',
            'description_1' => '',
            'title_2' => '',
            'description_2' => '',
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes']      = $this->getHolderClasses( $params );

		$html = holmes_core_get_shortcode_module_template_part( 'templates/image-with-description-template', 'image-with-description', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';

		return implode( ' ', $holderClasses );
	}
}
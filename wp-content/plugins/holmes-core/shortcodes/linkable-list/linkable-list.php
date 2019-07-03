<?php
namespace HolmesCore\CPT\Shortcodes\LinkableList;

use HolmesCore\Lib;

class LinkableList implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkdf_linkable_list';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'     => esc_html__( 'Linkable List', 'holmes-core' ),
					'base'     => $this->base,
					'icon'     => 'icon-wpb-linkable-list extended-custom-icon',
					'category' => esc_html__( 'by HOLMES', 'holmes-core' ),
					'params'   => array(
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
                            'type'       => 'dropdown',
                            'param_name' => 'skin',
                            'value' => array(
                                esc_html__('Default', 'holmes-core') => '',
                                esc_html__('Light', 'holmes-core') => 'mkdf-light-skin',
                            ),
                            'heading'    => esc_html__( 'Skin', 'holmes-core' )
                        ),
                        array(
                            'type'       => 'param_group',
                            'param_name' => 'list_items',
                            'heading'    => esc_html__( 'List Items', 'holmes-core' ),
                            'params'     => array(
                                array(
                                    'type'       => 'textfield',
                                    'param_name' => 'text',
                                    'heading'    => esc_html__( 'Title', 'holmes-core' ),
                                ),
                                array(
                                    'type'       => 'textfield',
                                    'param_name' => 'link',
                                    'heading'    => esc_html__( 'Link', 'holmes-core' )
                                )
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
            'skin' => '',
            'title' => '',
            'list_items' => ''
		);
		$params = shortcode_atts( $args, $atts );

		$params['holder_classes'] = $this->getHolderClasses( $params );
        $params['list_items'] = json_decode( urldecode( $params['list_items'] ), true );

		$html = holmes_core_get_shortcode_module_template_part( 'templates/linkable-list-template', 'linkable-list', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = $params['skin'];

		return implode( ' ', $holderClasses );
	}
		
}
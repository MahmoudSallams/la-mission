<?php

namespace HolmesCore\CPT\Shortcodes\ColoredClients;

use HolmesCore\Lib;

class ColoredClients implements Lib\ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'mkdf_colored_clients';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'     => esc_html__( 'Colored Clients', 'holmes-core' ),
					'base'     => $this->base,
					'category' => esc_html__( 'by HOLMES', 'holmes-core' ),
					'icon'     => 'icon-wpb-colored-clients extended-custom-icon',
					//'js_view'   => 'VcColumnView',
					'params'   => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Number of Columns', 'holmes-core' ),
							'value'       => array_flip( holmes_mkdf_get_number_of_columns_array( true, array(
								'five',
								'six'
							) ) ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'space_between_items',
							'heading'     => esc_html__( 'Space Between Items', 'holmes-core' ),
							'value'       => array_flip( holmes_mkdf_get_space_between_items_array() ),
							'save_always' => true
						),
						array(
							'type'       => 'param_group',
							'param_name' => 'clients',
							'heading'    => esc_html__( 'Clients Item', 'holmes-core' ),
							'group'      => esc_html__( 'Clients', 'holmes-core' ),
							'params'     => array(
								array(
									'type'       => 'textfield',
									'param_name' => 'link',
									'heading'    => esc_html__( 'Link', 'holmes-core' ),
								),
								array(
									'type'       => 'checkbox',
									'std'        => true,
									'param_name' => 'new_window',
									'heading'    => esc_html__( 'Open link in new tab?', 'holmes-core' ),
									'value'      => true,
								),
								array(
									'type'        => 'attach_image',
									'param_name'  => 'image',
									'heading'     => esc_html__( 'Image', 'holmes-core' ),
									'description' => esc_html__( 'Select image from media library', 'holmes-core' )
								),
								array(
									'type'        => 'attach_image',
									'param_name'  => 'logo',
									'heading'     => esc_html__( 'Logo', 'holmes-core' ),
									'description' => esc_html__( 'Select image from media library', 'holmes-core' )
								),
								array(
									'type'       => 'colorpicker',
									'param_name' => 'overlay_color',
									'heading'    => esc_html__( 'Image Overlay Color', 'holmes-core' )
								),
							)
						)
					)
				)
			);
		}
	}

	public function render( $atts, $content = null ) {
		$args = array(
			'number_of_columns'   => 'three',
			'space_between_items' => 'normal',
			'clients'             => ''
		);

		$params = shortcode_atts( $args, $atts );

		$params['clients']        = json_decode( urldecode( $params['clients'] ), true );
		$params['holder_classes'] = $this->getHolderClasses( $params, $args );

		$html = holmes_core_get_shortcode_module_template_part( 'templates/colored-clients', 'colored-clients', '', $params );

		return $html;
	}

	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();

		$holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'mkdf-' . $params['number_of_columns'] . '-columns' : 'mkdf-' . $args['number_of_columns'] . '-columns';
		$holderClasses[] = ! empty( $params['space_between_items'] ) ? 'mkdf-' . $params['space_between_items'] . '-space' : 'mkdf-' . $args['space_between_items'] . '-space';

		return implode( ' ', $holderClasses );
	}
}

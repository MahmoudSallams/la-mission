<?php

namespace HolmesCore\CPT\Shortcodes\FollowUs;

use HolmesCore\Lib;

class FollowUs implements Lib\ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'mkdf_follow_us';

		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Follow Us', 'holmes-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by HOLMES', 'holmes-core' ),
					'icon'                      => 'icon-wpb-follow-us extended-custom-icon',
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
							'heading'    => esc_html__( 'Title', 'holmes-core' ),
						),
						array(
							'type'       => 'checkbox',
							'param_name' => 'two_lines',
							'heading'    => esc_html__( 'Title above links?', 'holmes-core' ),
							'value'      => array(
								'' => 'true'
							),
							'dependency' => array(
								'element'   => 'title',
								'not_empty' => true,
							),
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'title_top_margin',
							'heading'    => esc_html__( 'Title top margin (px)', 'holmes-core' ),
							'dependency' => array(
								'element' => 'two_lines',
								'value'   => 'true',
							),
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'link_one',
							'heading'    => esc_html__( 'Link One', 'holmes-core' ),
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'label_one',
							'heading'    => esc_html__( 'Label One', 'holmes-core' ),
							'dependency' => array(
								'element'   => 'link_one',
								'not_empty' => true,
							),
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'link_two',
							'heading'    => esc_html__( 'Link Two', 'holmes-core' ),
							'dependency' => array(
								'element'   => 'link_one',
								'not_empty' => true,
							),
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'label_two',
							'heading'    => esc_html__( 'Label Two', 'holmes-core' ),
							'dependency' => array(
								'element'   => 'link_two',
								'not_empty' => true,
							),
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'link_three',
							'heading'    => esc_html__( 'Link Three', 'holmes-core' ),
							'dependency' => array(
								'element'   => 'link_two',
								'not_empty' => true,
							),
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'label_three',
							'heading'    => esc_html__( 'Label Three', 'holmes-core' ),
							'dependency' => array(
								'element'   => 'link_three',
								'not_empty' => true,
							),
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'link_four',
							'heading'    => esc_html__( 'Link Four', 'holmes-core' ),
							'dependency' => array(
								'element'   => 'link_three',
								'not_empty' => true,
							),
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'label_four',
							'heading'    => esc_html__( 'Label Four', 'holmes-core' ),
							'dependency' => array(
								'element'   => 'link_four',
								'not_empty' => true,
							),
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'target',
							'heading'     => esc_html__( 'Links Target', 'holmes-core' ),
							'std'         => '_blank',
							'value'       => array(
								esc_html__( 'Same Window' ) => '',
								esc_html__( 'New Window' )  => '_blank',
							),
							'save_always' => true,
							'dependency'  => array(
								'element'   => 'link_one',
								'not_empty' => true,
							),
						)
					)
				)
			);
		}
	}

	public function render( $atts, $content = null ) {
		$args = array(
			'custom_class'     => '',
			'title'            => '',
			'two_lines'        => '',
			'title_top_margin' => '',
			'link_one'         => '',
			'label_one'        => '',
			'link_two'         => '',
			'label_two'        => '',
			'link_three'       => '',
			'label_three'      => '',
			'link_four'        => '',
			'label_four'       => '',
			'target'           => '',
		);

		$params = shortcode_atts( $args, $atts );

		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['title_styles']   = $this->getTitleStyles( $params );

		$html = holmes_core_get_shortcode_module_template_part( 'templates/follow-us', 'follow-us', '', $params );

		return $html;
	}

	private function getHolderClasses( $params ) {
		$holderClasses = array();

		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = $params['two_lines'] === 'true' ? 'mkdf-fu--two-lines' : '';

		return implode( ' ', $holderClasses );
	}

	private function getTitleStyles( $params ) {
		$styles = array();

		$styles[] = ! empty( $params['title_top_margin'] ) ? 'margin-top:' . $params['title_top_margin'] . 'px' : '';

		return implode( ';', $styles );
	}
}
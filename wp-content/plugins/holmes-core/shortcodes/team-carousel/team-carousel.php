<?php

namespace HolmesCore\CPT\Shortcodes\Team;

use HolmesCore\Lib;

class TeamCarousel implements Lib\ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'mkdf_team_carousel';

		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Team Carousel', 'holmes-core' ),
					'base'                      => $this->base,
					'category'                  => esc_html__( 'by HOLMES', 'holmes-core' ),
					'icon'                      => 'icon-wpb-team-carousel extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'       => 'param_group',
							'param_name' => 'team_members',
							'heading'    => esc_html__( 'Team Members', 'holmes-core' ),
							'params'     => array(
								array(
									'type'       => 'attach_image',
									'param_name' => 'image',
									'heading'    => esc_html__( 'Image', 'holmes-core' ),
								),
								array(
									'type'       => 'textfield',
									'param_name' => 'subtitle',
									'heading'    => esc_html__( 'Subtitle', 'holmes-core' )
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
							)
						),
						//array(
						//    'type'        => 'dropdown',
						//    'param_name'  => 'slider_loop',
						//    'heading'     => esc_html__( 'Enable Slider Loop', 'holmes-core' ),
						//    'value'       => array_flip( holmes_mkdf_get_yes_no_select_array( false, true ) ),
						//    'save_always' => true,
						//    'group'       => esc_html__('Slider Settings', 'holmes-core')
						//),
						//array(
						//    'type'        => 'dropdown',
						//    'param_name'  => 'slider_autoplay',
						//    'heading'     => esc_html__( 'Enable Slider Autoplay', 'holmes-core' ),
						//    'value'       => array_flip( holmes_mkdf_get_yes_no_select_array( false, true ) ),
						//    'save_always' => true,
						//    'group'       => esc_html__('Slider Settings', 'holmes-core')
						//),
						//array(
						//    'type'        => 'textfield',
						//    'param_name'  => 'slider_speed',
						//    'heading'     => esc_html__( 'Slide Duration', 'holmes-core' ),
						//    'description' => esc_html__( 'Default value is 5000 (ms)', 'holmes-core' ),
						//    'group'       => esc_html__('Slider Settings', 'holmes-core')
						//),
						//array(
						//    'type'        => 'textfield',
						//    'param_name'  => 'slider_speed_animation',
						//    'heading'     => esc_html__( 'Slide Animation Duration', 'holmes-core' ),
						//    'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'holmes-core' ),
						//    'group'       => esc_html__('Slider Settings', 'holmes-core')
						//),
						//array(
						//    'type'        => 'dropdown',
						//    'param_name'  => 'slider_navigation',
						//    'heading'     => esc_html__( 'Enable Slider Navigation Arrows', 'holmes-core' ),
						//    'value'       => array_flip( holmes_mkdf_get_yes_no_select_array( false, true ) ),
						//    'save_always' => true,
						//    'group'       => esc_html__('Slider Settings', 'holmes-core')
						//)
					)
				)
			);
		}
	}

	public function render( $atts, $content = null ) {
		$args   = array(
			'team_members'            => '',
			//'number_of_visible_items' => '3',
			//'space_between_items'     => 'normal',
			//'slider_loop'             => 'yes',
			//'slider_autoplay'         => 'yes',
			//'slider_speed'            => '5000',
			//'slider_speed_animation'  => '600',
			//'slider_navigation'       => 'no',
			//'slider_pagination'       => 'no'
		);
		$params = shortcode_atts( $args, $atts );

		//$params['holder_classes'] = $this->getHolderClasses( $params, $args );
		//$params['slider_data']    = $this->getSliderData( $params );
		$params['team_members']   = json_decode( urldecode( $params['team_members'] ), true );

		$html = holmes_core_get_shortcode_module_template_part( 'templates/team-carousel', 'team-carousel', '', $params );

//		$html = '<div class="mkdf-team-carousel-holder ' . esc_attr( $holder_classes ) . '">';
//			$html .= '<div class="mkdf-tc-inner mkdf-owl-custom-slider" ' . holmes_mkdf_get_inline_attrs( $slider_data ) . '>';
//				$html .= do_shortcode( $content );
//			$html .= '</div>';
//		$html .= '</div>';

		return $html;
	}

	//private function getHolderClasses( $params, $args ) {
	//	$holderClasses = array();
	//
	//	$holderClasses[] = ! empty( $params['space_between_items'] ) ? 'mkdf-' . $params['space_between_items'] . '-space' : 'mkdf-' . $args['space_between_items'] . '-space';
	//
	//	return implode( ' ', $holderClasses );
	//}

	//private function getSliderData( $params ) {
	//	$slider_data = array();
	//
	//	$slider_data['data-number-of-items']        = $params['number_of_visible_items'] !== '' ? $params['number_of_visible_items'] : '3';
	//	$slider_data['data-enable-loop']            = ! empty( $params['slider_loop'] ) ? $params['slider_loop'] : '';
	//	$slider_data['data-enable-autoplay']        = ! empty( $params['slider_autoplay'] ) ? $params['slider_autoplay'] : '';
	//	$slider_data['data-slider-speed']           = ! empty( $params['slider_speed'] ) ? $params['slider_speed'] : '5000';
	//	$slider_data['data-slider-speed-animation'] = ! empty( $params['slider_speed_animation'] ) ? $params['slider_speed_animation'] : '600';
	//	$slider_data['data-enable-navigation']      = ! empty( $params['slider_navigation'] ) ? $params['slider_navigation'] : '';
	//	$slider_data['data-enable-pagination']      = ! empty( $params['slider_pagination'] ) ? $params['slider_pagination'] : '';
	//
	//	return $slider_data;
	//}
}
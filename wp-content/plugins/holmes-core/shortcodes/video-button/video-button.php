<?php

namespace HolmesCore\CPT\Shortcodes\VideoButton;

use HolmesCore\Lib;

class VideoButton implements Lib\ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'mkdf_video_button';

		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Video Button', 'holmes-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by HOLMES', 'holmes-core' ),
					'icon'                      => 'icon-wpb-video-button extended-custom-icon',
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
							'param_name' => 'video_link',
							'heading'    => esc_html__( 'Video Link', 'holmes-core' )
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'video_image',
							'heading'     => esc_html__( 'Video Image', 'holmes-core' ),
							'description' => esc_html__( 'Select image from media library', 'holmes-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'image_width',
							'heading'    => esc_html__( 'Video Image Width', 'holmes-core' ),
							'value'      => array(
								esc_html__( 'Original', 'holmes-core' ) => '',
								esc_html__( 'Small', 'holmes-core' )    => 'small',
								esc_html__( 'Medium', 'holmes-core' )   => 'medium',
								esc_html__( 'Large', 'holmes-core' )    => 'large',
							),
							'dependency' => array(
								'element'   => 'video_image',
								'not_empty' => true
							)
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'play_button_color',
							'heading'    => esc_html__( 'Play Button Color', 'holmes-core' )
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'play_button_image',
							'heading'     => esc_html__( 'Play Button Custom Image', 'holmes-core' ),
							'description' => esc_html__( 'Select image from media library. If you use this field then play button color and button size options will not work', 'holmes-core' )
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'play_button_hover_image',
							'heading'     => esc_html__( 'Play Button Custom Hover Image', 'holmes-core' ),
							'description' => esc_html__( 'Select image from media library. If you use this field then play button color and button size options will not work', 'holmes-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'enable_text',
							'heading'    => esc_html__( 'Enable Text', 'holmes-core' ),
							'value'      => array_flip( holmes_mkdf_get_yes_no_select_array( false ) )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'title',
							'heading'    => esc_html__( 'Title', 'holmes-core' ),
							'dependency' => Array( 'element' => 'enable_text', 'value' => array( 'yes' ) ),
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'subtitle',
							'heading'    => esc_html__( 'Subtitle', 'holmes-core' ),
							'dependency' => Array( 'element' => 'enable_text', 'value' => array( 'yes' ) ),
						)
					)
				)
			);
		}
	}

	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'            => '',
			'video_link'              => '#',
			'video_image'             => '',
			'play_button_color'       => '',
			'play_button_image'       => '',
			'play_button_hover_image' => '',
			'enable_text'             => 'no',
			'title'                   => '',
			'subtitle'                => '',
			'image_width'             => '',
		);
		$params = shortcode_atts( $args, $atts );

		$params['holder_classes']     = $this->getHolderClasses( $params );
		$params['play_button_styles'] = $this->getPlayButtonStyles( $params );

		$html = holmes_core_get_shortcode_module_template_part( 'templates/video-button', 'video-button', '', $params );

		return $html;
	}

	private function getHolderClasses( $params ) {
		$holderClasses = array();

		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['video_image'] ) ? 'mkdf-vb-has-img' : '';
		$holderClasses[] = ! empty( $params['image_width'] ) ? 'mkdf-' . $params['image_width'] : '';

		return implode( ' ', $holderClasses );
	}

	private function getPlayButtonStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['play_button_color'] ) ) {
			$styles[] = 'color: ' . $params['play_button_color'];
		}

		return implode( ';', $styles );
	}
}
<?php

namespace HolmesCore\CPT\Shortcodes\Team;

use HolmesCore\lib;

class Team implements lib\ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'mkdf_team';

		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {

		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Team', 'holmes-core' ),
					'base'                      => $this->base,
					'category'                  => esc_html__( 'by HOLMES', 'holmes-core' ),
					'icon'                      => 'icon-wpb-team extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'type',
							'heading'     => esc_html__( 'Type', 'holmes-core' ),
							'value'       => array(
								esc_html__( 'Info Below Image', 'holmes-core' )    => 'info-below-image',
								esc_html__( 'Info On Image Hover', 'holmes-core' ) => 'info-on-image'
							),
							'save_always' => true
						),
						array(
							'type'       => 'attach_image',
							'param_name' => 'team_image',
							'heading'    => esc_html__( 'Image', 'holmes-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'team_name',
							'heading'    => esc_html__( 'Name', 'holmes-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'team_name_tag',
							'heading'     => esc_html__( 'Name Tag', 'holmes-core' ),
							'value'       => array_flip( holmes_mkdf_get_title_tag( true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'team_name', 'not_empty' => true )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'team_name_color',
							'heading'    => esc_html__( 'Name Color', 'holmes-core' ),
							'dependency' => array( 'element' => 'team_name', 'not_empty' => true )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'link',
							'heading'    => esc_html__( 'Link', 'holmes-core' ),
							'dependency' => array(
								'element'   => 'team_name',
								'not_empty' => true,
							)
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'target',
							'heading'    => esc_html__( 'Target', 'holmes-core' ),
							'value'      => array_flip( holmes_mkdf_get_link_target_array() ),
							'dependency' => array(
								'element'   => 'link',
								'not_empty' => true,
							),
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'team_position',
							'heading'    => esc_html__( 'Position', 'holmes-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'team_number',
							'heading'    => esc_html__( 'Team Number', 'holmes-core' ),
							'dependency' => array( 'element' => 'type', 'value' => array( 'info-below-image' ) )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'team_text',
							'heading'    => esc_html__( 'Text', 'holmes-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'team_text_color',
							'heading'    => esc_html__( 'Text Color', 'holmes-core' ),
							'dependency' => array( 'element' => 'team_text', 'not_empty' => true )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'show_social_networks',
							'heading'    => esc_html__( 'Social networks', 'holmes-core' ),
							'value'      => array_flip( holmes_mkdf_get_yes_no_select_array( false ) ),
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'social_networks_title',
							'heading'    => esc_html__( 'Social networks title', 'holmes-core' ),
							'value'      => esc_html__( "Lets connect", 'holmes-core' ),
							'dependency' => array( 'element' => 'show_social_networks', 'value' => array( 'yes' ) )
						),
						array(
							'type'       => 'param_group',
							'param_name' => 'social_networks',
							'heading'    => esc_html__( 'Social Networks', 'holmes-core' ),
							'params'     => array(
								array(
									'type'       => 'textfield',
									'param_name' => 'abbr',
									'heading'    => esc_html__( 'Abbreviation', 'holmes-core' ),
								),
								array(
									'type'       => 'textfield',
									'param_name' => 'link',
									'heading'    => esc_html__( 'Link', 'holmes-core' )
								)
							),
							'dependency' => array( 'element' => 'show_social_networks', 'value' => array( 'yes' ) )
						)
					)
				)
			);
		}
	}

	public function render( $atts, $content = null ) {
		$args = array(
			'type'                  => 'info-below-image',
			'team_image'            => '',
			'team_name'             => '',
			'team_name_tag'         => 'h2',
			'team_name_color'       => '',
			'link'                  => '',
			'target'                => '_self',
			'team_position'         => '',
			'team_number'           => '',
			'team_text'             => '',
			'team_text_color'       => '',
			'show_social_networks'  => 'no',
			'social_networks_title' => 'Lets connect',
			'social_networks'       => '',
		);

		$params = shortcode_atts( $args, $atts );

		$params['type']             = ! empty( $params['type'] ) ? $params['type'] : $args['type'];
		$params['holder_classes']   = $this->getHolderClasses( $params );
		$params['team_name_tag']    = ! empty( $params['team_name_tag'] ) ? $params['team_name_tag'] : $args['team_name_tag'];
		$params['team_name_styles'] = $this->getTeamNameStyles( $params );
		$params['team_text_styles'] = $this->getTeamTextStyles( $params );
		$params['social_networks']  = json_decode( urldecode( $params['social_networks'] ), true );
		$params['target']           = ! empty( $params['target'] ) ? $params['target'] : $args['target'];

		//Get HTML from template based on type of team
		$html = holmes_core_get_shortcode_module_template_part( 'templates/' . $params['type'], 'team', '', $params );

		return $html;
	}

	private function getHolderClasses( $params ) {
		$holderClasses = array();

		$holderClasses[] = ! empty( $params['type'] ) ? 'mkdf-team-' . $params['type'] : '';

		return implode( ' ', $holderClasses );
	}

	private function getTeamNameStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['team_name_color'] ) ) {
			$styles[] = 'color: ' . $params['team_name_color'];
		}

		return implode( ';', $styles );
	}

	private function getTeamTextStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['team_text_color'] ) ) {
			$styles[] = 'color: ' . $params['team_text_color'];
		}

		return implode( ';', $styles );
	}
}
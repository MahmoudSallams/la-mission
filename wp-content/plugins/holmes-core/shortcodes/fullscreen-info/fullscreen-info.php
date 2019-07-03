<?php
namespace HolmesCore\CPT\Shortcodes\FullscreenInfo;

use HolmesCore\Lib;

class FullscreenInfo implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'mkdf_fullscreen_info';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Fullscreen Info', 'holmes-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by HOLMES', 'holmes-core' ),
					'icon'                      => 'icon-wpb-fullscreen-info extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'layout',
							'heading'     => esc_html__( 'Layout', 'holmes-core' ),
							'value'       => array(
								esc_html__( 'Intro Section', 'holmes-core' )   => 'intro',
								esc_html__( 'Outro Section', 'holmes-core' )   => 'outro',
							),
                            'admin_label' => true,
							'save_always' => true
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'intro_title',
							'heading'     => esc_html__( 'Intro Title', 'holmes-core' ),
                            'admin_label' => true,
							'group'		 => esc_html__('Intro Section', 'holmes-core'),
							'dependency' => array( 'element' => 'layout', 'value' => 'intro' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'intro_subtitle',
							'heading'     => esc_html__( 'Intro Subtitle', 'holmes-core' ),
							'group'		 => esc_html__('Intro Section', 'holmes-core'),
							'dependency' => array( 'element' => 'layout', 'value' => 'intro' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'intro_tagline',
							'heading'     => esc_html__( 'Intro Tagline', 'holmes-core' ),
							'group'		 => esc_html__('Intro Section', 'holmes-core'),
							'dependency' => array( 'element' => 'layout', 'value' => 'intro' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'outro_title',
							'heading'     => esc_html__( 'Outro Title', 'holmes-core' ),
                            'admin_label' => true,
							'group'		 => esc_html__('Outro Section', 'holmes-core'),
							'dependency' => array( 'element' => 'layout', 'value' => 'outro' )
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'outro_subtitle_img',
							'heading'     => esc_html__( 'Outro Subtitle Image', 'holmes-core' ),
							'group'		 => esc_html__('Outro Section', 'holmes-core'),
							'dependency' => array( 'element' => 'layout', 'value' => 'outro' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'btn_link',
							'heading'    => esc_html__( 'Button Link', 'holmes-core' ),
                            'admin_label' => true,
							'group'		 => esc_html__('Outro Section', 'holmes-core'),
							'dependency' => array( 'element' => 'layout', 'value' => 'outro' )
						),
						array(
                            'type'        => 'dropdown',
                            'param_name'  => 'btn_link_target',
                            'heading'     => esc_html__( 'Button Link Target', 'holmes-core' ),
                            'value'       => array_flip( holmes_mkdf_get_link_target_array() ),
							'save_always' => true,
							'group'		 => esc_html__('Outro Section', 'holmes-core'),
							'dependency' => array( 'element' => 'btn_link', 'not_empty' => true )
                        ),
						array(
                            'type'        => 'textfield',
                            'param_name'  => 'btn_text',
                            'heading'     => esc_html__( 'Text', 'holmes-core' ),
							'value'       => esc_html__( 'Button Text', 'holmes-core' ),
							'group'		 => esc_html__('Outro Section', 'holmes-core'),
							'dependency' => array( 'element' => 'btn_link', 'not_empty' => true )
						),
						array(
                            'type'        => 'textfield',
                            'param_name'  => 'btn_description',
							'heading'     => esc_html__( 'Button Description', 'holmes-core' ),
							'group'		 => esc_html__('Outro Section', 'holmes-core'),
							'dependency' => array( 'element' => 'btn_link', 'not_empty' => true )
						),
						array(
							'type'       => 'textarea',
							'param_name' => 'btm_info_left',
							'heading'    => esc_html__( 'Bottom Info Left', 'holmes-core' ),
							'group'		 => esc_html__('Outro Section', 'holmes-core'),
							'dependency' => array( 'element' => 'layout', 'value' => 'outro' )
						),
						array(
							'type'       => 'textarea',
							'param_name' => 'btm_info_center',
							'heading'    => esc_html__( 'Bottom Info Center', 'holmes-core' ),
							'group'		 => esc_html__('Outro Section', 'holmes-core'),
							'dependency' => array( 'element' => 'layout', 'value' => 'outro' )
						),
						array(
							'type'       => 'textarea',
							'param_name' => 'btm_info_right',
							'heading'    => esc_html__( 'Bottom Info Right', 'holmes-core' ),
							'group'		 => esc_html__('Outro Section', 'holmes-core'),
							'dependency' => array( 'element' => 'layout', 'value' => 'outro' )
						),
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'layout'           	=> 'intro',
			'intro_title' 		=> '',
			'intro_subtitle' 	=> '',
			'intro_tagline' 	=> '',
			'outro_title' 		=> '',
			'outro_subtitle' 	=> '',
			'outro_subtitle_img'	=> '',
			'btn_link'	=> '',
			'btn_link_target'	=> '',
			'btn_text'	=> '',
			'btn_description'	=> '',
			'btm_info_left'	=> '',
			'btm_info_center'	=> '',
			'btm_info_right'	=> '',
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes']  = $this->getHolderClasses( $params, $args );
		$html = holmes_core_get_shortcode_module_template_part( 'templates/'.$params['layout'].'-layout', 'fullscreen-info', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array('mkdf-fullscreen-info');
		
		$holderClasses[] = ! empty( $params['layout'] ) ? 'mkdf-fi-'.$params['layout'] : '';
		
		return implode( ' ', $holderClasses );
	}
}
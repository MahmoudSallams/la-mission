<?php
namespace HolmesCore\CPT\Shortcodes\IconShowcase;

use HolmesCore\Lib;

class IconShowcaseItem implements Lib\ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'mkdf_icon_showcase_item';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if(function_exists('vc_map')){
			vc_map( 
				array(
					'name' => esc_html__('Icon Showcase Item', 'holmes-core'),
					'base' => $this->base,
					'as_child' => array('only' => 'mkdf_icon_showcase'),
					'category' => 'by HOLMES',
					'icon' => 'icon-wpb-icon-showcase-item extended-custom-icon',
					'params' => array_merge(
						holmes_mkdf_icon_collections()->getVCParamsArray(),
						array(
							array(
								'type' => 'colorpicker',
								'heading' => esc_html__('Icon Background Color', 'holmes-core'),
								'param_name' => 'icon_background_color',
								'description' => ''
							),
                            array(
                                'type'       => 'colorpicker',
                                'param_name' => 'icon_color',
                                'heading'    => esc_html__( 'Icon Color', 'holmes-core' )
                            ),
							array(
								'type' => 'textfield',
								'class' => '',
								'heading' => esc_html__('Title', 'holmes-core'),
								'param_name' => 'title',
								'value' => '',
								'description' => ''
							),
							array(
								'type'       => 'dropdown',
								'heading' => esc_html__('Title Tag', 'holmes-core'),
								'param_name' => 'title_tag',
								'value'      => holmes_mkdf_get_title_tag(true),
								'dependency' => array('element' => 'title', 'not_empty' => true)
							),
							array(
								'type' => 'textarea_html',
								'class' => '',
								'heading' => esc_html__('Content', 'holmes-core'),
								'param_name' => 'content',
								'value' => ''
							)
						)
					)
				)
			);			
		}
	}

	public function render($atts, $content = null) {
		$args = array(
			'icon_background_color' => '',
			'icon_color' => '',
			'subtitle' => '',
			'title' => '',
			'title_tag' => 'h3'
		);

        $args = array_merge($args, holmes_mkdf_icon_collections()->getShortcodeParams());
		$params = shortcode_atts($args, $atts);

		$params['content'] = $content;
		$params['icon_params'] = $this->getIconParameters($params);

		$html = holmes_core_get_shortcode_module_template_part('templates/showcase-item-template', 'icon-showcase', '', $params);

		return $html;
	}

    /**
     * Returns parameters for icon shortcode as a string
     *
     * @param $params
     *
     * @return array
     */
	private function getIconParameters($params) {
        $params_array = array();

        $iconPackName = holmes_mkdf_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);

        $params_array['icon_pack']   = $params['icon_pack'];
        $params_array[$iconPackName] = $params[$iconPackName];

		if ($params['icon_background_color'] !== ''){
			$params_array['background_color'] = $params['icon_background_color'];
		}

        if ($params['icon_color'] !== ''){
            $params_array['icon_color'] = $params['icon_color'];
        }

        $params_array['type'] = 'mkdf-circle';
		$params_array['size'] = 'mkdf-icon-medium';

        return $params_array;
    }
}

<?php
namespace HolmesCore\CPT\Shortcodes\IconShowcase;

use HolmesCore\Lib;

class IconShowcase implements Lib\ShortcodeInterface {
	private $base;
	function __construct() {
		$this->base = 'mkdf_icon_showcase';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Interactive Icon Showcase', 'holmes-core'),
			'base' => $this->base,
			'icon' => 'icon-wpb-icon-showcase extended-custom-icon',
			'category'  => esc_html__( 'by HOLMES', 'holmes-core' ),
			'as_parent' => array('only' => 'mkdf_icon_showcase_item'),
			'show_settings_on_create' => true,
			'js_view' => 'VcColumnView',
			'params' => array(
				array(
					'type' => 'dropdown',
					'admin_label' => true,
					'heading' => esc_html__('Autoplay', 'holmes-core'),
					'param_name' => 'autoplay',
					'value' => array_flip(holmes_mkdf_get_yes_no_select_array(false)),
					'save_always' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => esc_html__('Autoplay Interval (ms)', 'holmes-core'),
					'param_name' => 'autoplay_interval',
					'save_always' => true,
					'description' => esc_html__('Default value is 3000.', 'holmes-core')
				),
			)
		));
	}

	public function render($atts, $content = null) {
		$args = array(
			'autoplay' => 'yes',
			'autoplay_interval' => '3000',
		);

		$params = shortcode_atts($args, $atts);

		$icon_showcase_classes = array();
		$icon_showcase_classes[] = 'mkdf-int-icon-showcase';
		if ($params['autoplay'] == 'yes') {
			$icon_showcase_classes[] = 'mkdf-autoplay';
		}
		$icon_showcase_class = implode(' ', $icon_showcase_classes);

        $data_attr = $this->getDataAttr($params);


		$html = '';

		$html .= '<div '. holmes_mkdf_get_class_attribute($icon_showcase_class) . holmes_mkdf_get_inline_attrs($data_attr) . '>';
		$html .= '<div class="mkdf-int-icon-showcase-inner">';
		$html .= do_shortcode($content);
		$html .= '</div>';
		$html .= '<div class="mkdf-int-icon-circle"></div>';
		$html .= '</div>';

		return $html;

	}

	/**
	 *
	 * Returns array of data attr
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getDataAttr($params) {
	    $data_attr = array();

	    if(!empty($params['autoplay_interval'])) {
	        $data_attr['data-interval'] = $params['autoplay_interval'];
	    }

	    return $data_attr;
	}

}

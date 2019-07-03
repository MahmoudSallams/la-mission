<?php
namespace HolmesCore\CPT\Shortcodes\SlidingImageHolder;

use HolmesCore\Lib;

/**
 * Class SlidingImageHolder
 */
class SlidingImageHolder implements Lib\ShortcodeInterface {
	private $base;

	public function __construct() {

        $this->base = 'mkdf_sliding_image_holder';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

    public function vcMap() {
        if ( function_exists( 'vc_map' ) ) {
            vc_map(
                array(
                    'name'                      => esc_html__( 'Sliding Image Holder', 'holmes-core' ),
                    'base'                      => $this->getBase(),
                    'content_element'           => true,
                    'category'                  => esc_html__( 'by HOLMES', 'holmes-core' ),
                    'icon'                      => 'icon-wpb-sliding-image-holder extended-custom-icon',
                    'as_parent'                 => array( 'except' => 'vc_row, vc_accordion' ),
                    'js_view'                   => 'VcColumnView',
                    'params'                    => array(
                        array(
                            'type'			=> 'attach_image',
                            'heading'		=> esc_html__('Image','holmes-core'),
                            'admin_label'	=> true,
                            'param_name'	=> 'image',
                            'description'	=> esc_html__('Recommended width of image is 1920px', 'holmes-core')
                        )
                    )
                )
            );
        }
    }

	public function render($atts, $content = null) {
		$default_attrs = array(
			'image' => ''
        );
		$params        = shortcode_atts($default_attrs, $atts);

		extract($params);

		$params['content'] = $content;

		return holmes_core_get_shortcode_module_template_part('templates/sliding-image-holder-template', 'sliding-image-holder', '', $params);
	}
}
<?php

namespace HolmesInstagram\Shortcodes\InstagramList;

use HolmesInstagram\Lib;


class InstagramList implements Lib\ShortcodeInterface
{
    private $base;

    public function __construct()
    {
        $this->base = 'mkdf_instagram_list';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase()
    {
        return $this->base;
    }

    public function vcMap()
    {
        if (function_exists('vc_map')) {
            vc_map(
                array(
                    'name' => esc_html__('Mikado Instagram List', 'holmes-instagram-feed'),
                    'base' => $this->base,
                    'category' => esc_html__('by HOLMES', 'holmes-instagram-feed'),
                    'icon' => 'icon-wpb-instagram-list extended-custom-icon',
                    'allowed_container_element' => 'vc_row',
                    'params' => array(
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'number_of_columns',
                            'heading' => esc_html__('Number of Columns', 'holmes-instagram-feed'),
                            'value' => array_flip(holmes_mkdf_get_number_of_columns_array(false, array('one'), array(
                                'ten' => 'Ten',
                                'eleven' => 'Eleven',
                            ))),
                            'save_always' => true
                        ),
                        array(
                            'param_name' => 'type',
                            'type' => 'dropdown',
                            'heading' => esc_html__('Type', 'holmes-instagram-feed'),
                            'value' => array(
                                esc_html__( 'Gallery', 'holmes-instagram-feed') => 'gallery',
                                esc_html__( 'Carousel', 'holmes-instagram-feed') => 'carousel'
                            )
                        ),
                        array(
                            'param_name' => 'space_between_columns',
                            'type' => 'dropdown',
                            'heading' => esc_html__('Space Between Items', 'holmes-instagram-feed'),
                            'value' => array_flip(holmes_mkdf_get_space_between_items_array())
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'number_of_photos',
                            'heading' => esc_html__('Number of Photos', 'holmes-instagram-feed')
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'transient_time',
                            'heading' => esc_html__('Images Cache Time', 'holmes-instagram-feed')
                        ),

                        array(
                            'param_name' => 'show_instagram_icon',
                            'type' => 'dropdown',
                            'heading' => esc_html__('Show Instagram Icon', 'holmes-instagram-feed'),
                            'value' => array_flip(holmes_mkdf_get_yes_no_select_array(false)),
                        ),

                        array(
                            'param_name' => 'image_size',
                            'type' => 'dropdown',
                            'heading' => esc_html__('Image Size', 'holmes-instagram-feed'),
                            'value' => array(
                                esc_html__( 'Small', 'holmes-instagram-feed') => 'thumbnail',
                                esc_html__( 'Medium', 'holmes-instagram-feed') => 'low_resolution',
                                esc_html__( 'Large', 'holmes-instagram-feed') => 'standard_resolution'
                            )
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'slider_loop',
                            'heading' => esc_html__('Enable Slider Loop', 'holmes-instagram-feed'),
                            'value' => array_flip(holmes_mkdf_get_yes_no_select_array(false, true)),
                            'save_always' => true,
                            'group' => esc_html__('Slider Settings', 'holmes-instagram-feed')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'slider_autoplay',
                            'heading' => esc_html__('Enable Slider Autoplay', 'holmes-instagram-feed'),
                            'value' => array_flip(holmes_mkdf_get_yes_no_select_array(false, true)),
                            'save_always' => true,
                            'group' => esc_html__('Slider Settings', 'holmes-instagram-feed')
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'slider_speed',
                            'heading' => esc_html__('Slide Duration', 'holmes-instagram-feed'),
                            'description' => esc_html__('Default value is 5000 (ms)', 'holmes-instagram-feed'),
                            'group' => esc_html__('Slider Settings', 'holmes-instagram-feed')
                        ),
                        array(
                            'type' => 'textfield',
                            'param_name' => 'slider_speed_animation',
                            'heading' => esc_html__('Slide Animation Duration', 'holmes-instagram-feed'),
                            'description' => esc_html__('Speed of slide animation in milliseconds. Default value is 600.', 'holmes-instagram-feed'),
                            'group' => esc_html__('Slider Settings', 'holmes-instagram-feed')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'slider_navigation',
                            'heading' => esc_html__('Enable Slider Navigation Arrows', 'holmes-instagram-feed'),
                            'value' => array_flip(holmes_mkdf_get_yes_no_select_array(false, true)),
                            'save_always' => true,
                            'group' => esc_html__('Slider Settings', 'holmes-instagram-feed')
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'slider_pagination',
                            'heading' => esc_html__('Enable Slider Pagination', 'holmes-instagram-feed'),
                            'value' => array_flip(holmes_mkdf_get_yes_no_select_array(false, false)),
                            'save_always' => true,
                            'group' => esc_html__('Slider Settings', 'holmes-instagram-feed')
                        )
                    )
                )
            );
        }
    }

    public function render($atts, $content = null)
    {
        $args = array(
            'number_of_columns' => '3',
            'space_between_columns' => 'normal',
            'number_of_photos' => '',
            'transient_time' => '',
            'show_instagram_icon' => 'no',
            'type' => 'gallery',
            'image_size' => 'thumbnail',
            'slider_loop' => 'yes',
            'slider_autoplay' => 'yes',
            'slider_speed' => '5000',
            'slider_speed_animation' => '600',
            'slider_navigation' => 'yes',
            'slider_pagination' => 'no'
        );
        $params = shortcode_atts($args, $atts);
        extract($params);

        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['carousel_classes'] = $this->getCarouselClasses($params);

        $instagram_api = new \HolmesInstagramApi();
        $params['instagram_api'] = $instagram_api;

        $images_array = $instagram_api->getImages($params['number_of_photos'], array(
            'use_transients' => true,
            'transient_name' => rand(0, 1000),
            'transient_time' => $params['transient_time']
        ));

        $params['images_array'] = $images_array;
        $params['data_attr'] = $this->getSliderData($params);

        //Get HTML from template based on type of team
        $html = holmes_instagram_get_shortcode_module_template_part('templates/holder', 'instagram-list', '', $params);

        return $html;
    }

    public function getHolderClasses($params)
    {
        $holderClasses = array();

        $holderClasses[] = $this->getColumnNumberClass($params['number_of_columns']);
        $holderClasses[] = !empty($params['space_between_columns']) ? 'mkdf-' . $params['space_between_columns'] . '-space' : 'mkdf-il-normal-space';

        return implode(' ', $holderClasses);
    }


    public function getCarouselClasses($params)
    {
        $carouselClasses = array();

        if ($params['type'] === 'carousel') {
            $carouselClasses = 'mkdf-instagram-carousel mkdf-owl-slider';

        } else if ($params['type'] == 'gallery') {
            $carouselClasses = 'mkdf-instagram-gallery';
        }

        return $carouselClasses;
    }


    public function getColumnNumberClass($params)
    {
        switch ($params) {
            case 1:
                $classes = 'mkdf-il-one-column';
                break;
            case 2:
                $classes = 'mkdf-il-two-columns';
                break;
            case 3:
                $classes = 'mkdf-il-three-columns';
                break;
            case 4:
                $classes = 'mkdf-il-four-columns';
                break;
            case 5:
                $classes = 'mkdf-il-five-columns';
                break;
            default:
                $classes = 'mkdf-il-three-columns';
                break;
        }

        return $classes;
    }

    private function getSliderData($params)
    {
        $slider_data = array();

        switch($params['number_of_columns']) {
            case 'one':
                $number_of_carousel_columns = '1';
                break;
            case 'two':
                $number_of_carousel_columns = '2';
                break;
            case 'three':
                $number_of_carousel_columns = '3';
                break;
            case 'four':
                $number_of_carousel_columns = '4';
                break;
            case 'five':
                $number_of_carousel_columns = '5';
                break;
            case 'six':
                $number_of_carousel_columns = '6';
                break;
            case 'ten':
                $number_of_carousel_columns = '10';
                break;
            case 'eleven':
                $number_of_carousel_columns = '11';
                break;
            default:
                $number_of_carousel_columns = '4';
                break;
        }

        $slider_data['data-number-of-items'] = $number_of_carousel_columns;
        $slider_data['data-enable-loop'] = !empty($params['slider_loop']) ? $params['slider_loop'] : '';
        $slider_data['data-enable-autoplay'] = !empty($params['slider_autoplay']) ? $params['slider_autoplay'] : '';
        $slider_data['data-slider-speed'] = !empty($params['slider_speed']) ? $params['slider_speed'] : '5000';
        $slider_data['data-slider-speed-animation'] = !empty($params['slider_speed_animation']) ? $params['slider_speed_animation'] : '600';
        $slider_data['data-enable-navigation'] = !empty($params['slider_navigation']) ? $params['slider_navigation'] : '';
        $slider_data['data-enable-pagination'] = !empty($params['slider_pagination']) ? $params['slider_pagination'] : '';

        return $slider_data;
    }
}
<?php

namespace HolmesCore\CPT\Shortcodes\Portfolio;

use HolmesCore\Lib;

class PortfolioPair implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'mkdf_portfolio_pair';

        add_action( 'vc_before_init', array( $this, 'vcMap' ) );

        //Small portfolio id filter
        add_filter( 'vc_autocomplete_mkdf_portfolio_pair_small_portfolio_id_callback', array( &$this, 'smallPortfolioIdAutocompleteSuggester', ), 10, 1 );

        //Small portfolio id render
        add_filter( 'vc_autocomplete_mkdf_portfolio_pair_small_portfolio_id_render', array( &$this, 'smallPortfolioIdAutocompleteRender', ), 10, 1 );

        //Big portfolio id filter
        add_filter( 'vc_autocomplete_mkdf_portfolio_pair_big_portfolio_id_callback', array( &$this, 'bigPortfolioIdAutocompleteSuggester', ), 10, 1 );

        //Big portfolio id render
        add_filter( 'vc_autocomplete_mkdf_portfolio_pair_big_portfolio_id_render', array( &$this, 'bigPortfolioIdAutocompleteRender', ), 10, 1 );
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if ( function_exists( 'vc_map' ) ) {
            vc_map( array(
                    'name'     => esc_html__( 'Portfolio Pair', 'holmes-core' ),
                    'base'     => $this->getBase(),
                    'category' => esc_html__( 'by HOLMES', 'holmes-core' ),
                    'icon'     => 'icon-wpb-portfolio-pair extended-custom-icon',
                    'params'   => array(
                        array(
                            'type'        => 'autocomplete',
                            'param_name'  => 'big_portfolio_id',
                            'heading'     => esc_html__( 'Big Portfolio', 'holmes-core' ),
                            'settings'    => array(
                                'sortable'      => true,
                                'unique_values' => true
                            ),
                            'admin_label' => true,
                            'save_always' => true,
                            'description' => esc_html__( 'If you left this field empty then portfolio ID will be of the current page', 'holmes-core' )
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'enable_custom_image_1',
                            'heading'     => esc_html__( 'Enable Custom Image For Big Portfolio', 'holmes-core' ),
                            'value'       => array_flip(holmes_mkdf_get_yes_no_select_array(false)),
                            'admin_label' => true,
                            'save_always' => true,
                        ),
                        array(
                            'type'        => 'attach_image',
                            'param_name'  => 'custom_image_1',
                            'heading'     => esc_html__( 'Custom Image', 'holmes-core' ),
                            'value'       => holmes_mkdf_get_yes_no_select_array(false),
                            'admin_label' => true,
                            'save_always' => true,
                            'dependency'  => array('element' => 'enable_custom_image_1', 'value' => 'yes')
                        ),
                        array(
                            'type'        => 'autocomplete',
                            'param_name'  => 'small_portfolio_id',
                            'heading'     => esc_html__( 'Small Portfolio', 'holmes-core' ),
                            'settings'    => array(
                                'sortable'      => true,
                                'unique_values' => true
                            ),
                            'admin_label' => true,
                            'save_always' => true,
                            'description' => esc_html__( 'If you left this field empty then portfolio ID will be of the current page', 'holmes-core' )
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'enable_custom_image_2',
                            'heading'     => esc_html__( 'Enable Custom Image For Small Portfolio', 'holmes-core' ),
                            'value'       => array_flip(holmes_mkdf_get_yes_no_select_array(false)),
                            'admin_label' => true,
                            'save_always' => true,
                        ),
                        array(
                            'type'        => 'attach_image',
                            'param_name'  => 'custom_image_2',
                            'heading'     => esc_html__( 'Custom Image', 'holmes-core' ),
                            'value'       => holmes_mkdf_get_yes_no_select_array(false),
                            'admin_label' => true,
                            'save_always' => true,
                            'dependency'  => array('element' => 'enable_custom_image_2', 'value' => 'yes')
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'title_tag',
                            'heading'    => esc_html__( 'Title Tag', 'holmes-core' ),
                            'value'      => array_flip( holmes_mkdf_get_title_tag( true ) ),
                            'dependency' => array( 'element' => 'enable_title', 'value' => array( 'yes' ) ),
                            'group'      => esc_html__( 'Content Layout', 'holmes-core' )
                        ),
                        array(
                            'type' => 'dropdown',
                            'param_name' => 'layout',
                            'heading' => esc_html__('Layout order','holmes-core'),
                            'value' => array(
                                esc_html__('Small Portfolio On The Left','holmes-core') => '',
                                esc_html__('Big Portfolio On The Left','holmes-core') => 'mkdf-big-portfolio-first',
                            ),
                            'group'      => esc_html__( 'Content Layout', 'holmes-core' )
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'enable_category',
                            'heading'    => esc_html__( 'Enable Category', 'holmes-core' ),
                            'value'      => array_flip( holmes_mkdf_get_yes_no_select_array( false, true ) ),
                            'group'      => esc_html__( 'Content Layout', 'holmes-core' )
                        )
                    )
                )
            );
        }
    }

    public function render( $atts, $content = null ) {
        $args   = array(
            'big_portfolio_id'         => '',
            'small_portfolio_id'       => '',
            'enable_custom_image_2'    => 'no',
            'enable_custom_image_1'    => 'no',
            'custom_image_2'           => '',
            'custom_image_1'           => '',
            'title_tag'                => 'h5',
            'enable_category'          => 'yes',
            'layout'                   => '',
        );
        $params = shortcode_atts( $args, $atts );

        $params['small_portfolio_id'] = !empty($params['small_portfolio_id']) ? $params['small_portfolio_id'] : get_the_ID();
        $params['big_portfolio_id'] = !empty($params['big_portfolio_id']) ? $params['big_portfolio_id'] : get_the_ID();

        $params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : $args['title_tag'];

        $params['portfolios'] = array();
        $params['portfolios'][] = array('class_name' => 'mkdf-small-portfolio', 'portfolio_id' => $params['small_portfolio_id'], 'image_size' => 'aoki_mkdf_square', 'enable_custom_image' => $params['enable_custom_image_2'], 'custom_image' => $params['custom_image_2'] );
        $params['portfolios'][] = array('class_name' => 'mkdf-big-portfolio', 'portfolio_id' => $params['big_portfolio_id'], 'image_size' => 'aoki_mkdf_portrait', 'enable_custom_image' => $params['enable_custom_image_1'], 'custom_image' => $params['custom_image_1'] );


        $additional_params['holder_classes'] = $this->getHolderClasses( $params, $args );

        $params['this_object'] = $this;

        $html = holmes_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-pair', 'portfolio-pair-holder', '', $params, $additional_params );

        return $html;
    }

    public function getHolderClasses( $params, $args ) {
        $classes = array();

        $classes[] = $params['layout'];

        return implode( ' ', $classes );
    }

    public function getArticleClasses( $params ) {
        $classes = array();

        $item_style = $params['item_style'];

        if ( get_post_meta( get_the_ID(), "mkdf_portfolio_featured_image_meta", true ) !== "" && $item_style === 'standard-switch-images' ) {
            $classes[] = 'mkdf-pl-has-switch-image';
        } elseif ( get_post_meta( get_the_ID(), "mkdf_portfolio_featured_image_meta", true ) === "" && $item_style === 'standard-switch-images' ) {
            $classes[] = 'mkdf-pl-no-switch-image';
        }

        $article_classes = get_post_class( $classes );

        return implode( ' ', $article_classes );
    }

    public function getTitleStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['title_text_transform'] ) ) {
            $styles[] = 'text-transform: ' . $params['title_text_transform'];
        }

        return implode( ';', $styles );
    }

    public function getSwitchFeaturedImage() {
        $featured_image_meta = get_post_meta( get_the_ID(), 'mkdf_portfolio_featured_image_meta', true );

        $featured_image = ! empty( $featured_image_meta ) ? esc_url( $featured_image_meta ) : '';

        return $featured_image;
    }

    /**
     * Filter portfolios by ID or Title
     *
     * @param $query
     *
     * @return array
     */
    public function smallPortfolioIdAutocompleteSuggester( $query ) {
        global $wpdb;
        $portfolio_id    = (int) $query;
        $post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts} 
					WHERE post_type = 'portfolio-item' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $portfolio_id > 0 ? $portfolio_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

        $results = array();
        if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
            foreach ( $post_meta_infos as $value ) {
                $data          = array();
                $data['value'] = $value['id'];
                $data['label'] = esc_html__( 'Id', 'holmes-core' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'holmes-core' ) . ': ' . $value['title'] : '' );
                $results[]     = $data;
            }
        }

        return $results;
    }

    /**
     * Find portfolio by id
     * @since 4.4
     *
     * @param $query
     *
     * @return bool|array
     */
    public function smallPortfolioIdAutocompleteRender( $query ) {
        $query = trim( $query['value'] ); // get value from requested
        if ( ! empty( $query ) ) {
            // get portfolio
            $portfolio = get_post( (int) $query );
            if ( ! is_wp_error( $portfolio ) ) {

                $portfolio_id    = $portfolio->ID;
                $portfolio_title = $portfolio->post_title;

                $portfolio_title_display = '';
                if ( ! empty( $portfolio_title ) ) {
                    $portfolio_title_display = ' - ' . esc_html__( 'Title', 'holmes-core' ) . ': ' . $portfolio_title;
                }

                $portfolio_id_display = esc_html__( 'Id', 'holmes-core' ) . ': ' . $portfolio_id;

                $data          = array();
                $data['value'] = $portfolio_id;
                $data['label'] = $portfolio_id_display . $portfolio_title_display;

                return ! empty( $data ) ? $data : false;
            }

            return false;
        }

        return false;
    }

    /**
     * Filter portfolios by ID or Title
     *
     * @param $query
     *
     * @return array
     */
    public function bigPortfolioIdAutocompleteSuggester( $query ) {
        global $wpdb;
        $portfolio_id    = (int) $query;
        $post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts} 
					WHERE post_type = 'portfolio-item' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $portfolio_id > 0 ? $portfolio_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

        $results = array();
        if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
            foreach ( $post_meta_infos as $value ) {
                $data          = array();
                $data['value'] = $value['id'];
                $data['label'] = esc_html__( 'Id', 'holmes-core' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'holmes-core' ) . ': ' . $value['title'] : '' );
                $results[]     = $data;
            }
        }

        return $results;
    }

    /**
     * Find portfolio by id
     * @since 4.4
     *
     * @param $query
     *
     * @return bool|array
     */
    public function bigPortfolioIdAutocompleteRender( $query ) {
        $query = trim( $query['value'] ); // get value from requested
        if ( ! empty( $query ) ) {
            // get portfolio
            $portfolio = get_post( (int) $query );
            if ( ! is_wp_error( $portfolio ) ) {

                $portfolio_id    = $portfolio->ID;
                $portfolio_title = $portfolio->post_title;

                $portfolio_title_display = '';
                if ( ! empty( $portfolio_title ) ) {
                    $portfolio_title_display = ' - ' . esc_html__( 'Title', 'holmes-core' ) . ': ' . $portfolio_title;
                }

                $portfolio_id_display = esc_html__( 'Id', 'holmes-core' ) . ': ' . $portfolio_id;

                $data          = array();
                $data['value'] = $portfolio_id;
                $data['label'] = $portfolio_id_display . $portfolio_title_display;

                return ! empty( $data ) ? $data : false;
            }

            return false;
        }

        return false;
    }
}
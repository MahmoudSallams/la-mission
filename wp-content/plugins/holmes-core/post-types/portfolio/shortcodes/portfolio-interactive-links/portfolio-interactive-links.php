<?php
namespace HolmesCore\CPT\Shortcodes\Portfolio;

use HolmesCore\Lib;

class PortfolioInteractiveLinks implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'mkdf_interactive_portfolio_links';

        //Portfolio category filter
        add_filter( 'vc_autocomplete_mkdf_interactive_portfolio_links_category_callback', array( &$this, 'portfolioCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

        //Portfolio category render
        add_filter( 'vc_autocomplete_mkdf_interactive_portfolio_links_category_render', array( &$this, 'portfolioCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array


        add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 */
	public function vcMap() {
		if(function_exists('vc_map')) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Interactive Portfolio Links', 'holmes-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by HOLMES', 'holmes-core' ),
					'icon'                      => 'icon-wpb-interactive-portfolio-showcase extended-custom-icon',
                    'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
                            'type'        => 'textfield',
                            'param_name'  => 'font_size',
                            'heading'     => esc_html__( 'Font Size', 'holmes-core' ),
                            'description' => esc_html__( 'Font Size (px)', 'holmes-core' ),
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'letter_spacing',
                            'heading'     => esc_html__( 'Letter Spacing', 'holmes-core' ),
                            'description' => esc_html__( 'Letter Spacing (px or em)', 'holmes-core' ),
                        ),
                        array(
                            "type"        => "dropdown",
                            "heading"     => esc_html__("Font weight", 'holmes-core'),
                            "param_name"  => "font_weight",
                            "value"       => array_flip(holmes_mkdf_get_font_weight_array(true)),
                            "save_always" => true
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__('Text Alignment', 'holmes-core'),
                            'param_name' => 'text_alignment',
                            'value' => array(
                                esc_html__('Default', 'holmes-core') => '',
                                esc_html__('Left', 'holmes-core') => 'left',
                                esc_html__('Center', 'holmes-core') => 'center',
                                esc_html__('Right', 'holmes-core') => 'right'
                            ),
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__('Skin', 'holmes-core'),
                            'param_name' => 'skin',
                            'value' => array(
                                esc_html__('Dark', 'holmes-core') => 'dark',
                                esc_html__('Light', 'holmes-core') => 'light'
                            ),
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'target',
                            'heading'     => esc_html__( 'Link Target', 'holmes-core' ),
                            'value'       => array_flip( holmes_mkdf_get_link_target_array() ),
                            'save_always' => true
                        ),
                        array(
							'type'       => 'dropdown',
							'param_name' => 'enable_link_items_scroll',
							'heading'    => esc_html__( 'Enable Link Items Scroll', 'holmes-core' ),
							'value'      => array_flip( holmes_mkdf_get_yes_no_select_array( false, true ) )
						),
                        array(
                            'type'        => 'autocomplete',
                            'param_name'  => 'category',
                            'heading'     => esc_html__( 'One-Category Portfolio List', 'holmes-core' ),
                            'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'holmes-core' )
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'enable_intro_section',
                            'heading'    => esc_html__( 'Enable Intro Section', 'holmes-core' ),
                            'value'      => array_flip( holmes_mkdf_get_yes_no_select_array( false, true ) ),
                            'admin_label' => true,
                            'group'      => esc_html__( 'Intro Section', 'holmes-core' )
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'intro_text',
                            'heading'     => esc_html__( 'Intro Text', 'holmes-core' ),
                            'dependency'  => array( 'element' => 'enable_intro_section', 'value' => array( 'yes' ) ),
                            'admin_label' => true,
                            'group'       => esc_html__( 'Intro Section', 'holmes-core' )
                        ),
                    )
				)
			);
		}
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null) {
		$args = array(
         	'font_size'					=> '',
            'letter_spacing'            => '',
            'font_weight'               => '',
         	'text_alignment'			=> 'left',
            'skin'                      => '',
            'target'            		=> '_self',
            'enable_link_items_scroll' 	=> 'yes',
            'link_items'        		=> '',
            'category'                  => '',
            'enable_intro_section'      => 'yes',
            'intro_text'                => '',
		);
		
		$params = shortcode_atts($args, $atts);
        $params['content'] = $content;
        $params['text_style'] = $this->getTextStyles($params);
        $params['text_copy_style'] = $this->getTextCopyStyles($params);
		$params['ips_classes'] = $this->getIPSClasses($params);

        $query_array                        = $this->getQueryArray( $params );
        $query_results                      = new \WP_Query( $query_array );
        $additional_params['query_results'] = $query_results;

        $html = holmes_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-interactive-links', 'portfolio-interactive-links-holder', '', $params, $additional_params );
		
		return $html;
	}


	private function getTextStyles($params) {
		$text_style = array();

		if ($params['font_size'] !== '') {
			$text_style[] = 'font-size: '.$params['font_size'];
		}

        if ($params['letter_spacing'] !== '') {
            $text_style[] = 'letter-spacing: '.$params['letter_spacing'];
        }

        if ($params['font_weight'] !== '') {
            $text_style[] = 'font-weight: '.$params['font_weight'];
        }

		if ($params['text_alignment'] !== '') {
			$text_style[] = 'text-align: '.$params['text_alignment'];
		}

		return implode(';', $text_style);
	}

	private function getTextCopyStyles($params) {
		$text_style = array();

        if ($params['letter_spacing'] !== '') {
            $text_style[] = 'letter-spacing: '.$params['letter_spacing'];
        }

        if ($params['font_weight'] !== '') {
            $text_style[] = 'font-weight: '.$params['font_weight'];
        }

		return implode(';', $text_style);
	}

	/**
     * Returns array of HTML classes for Interactive Link Showcase
     *
     * @param $params
     *
     * @return array
     */
    private function getIPSClasses($params) {
        $ipsClasses = array('mkdf-ips');

        if(!empty($params['enable_link_items_scroll']) && $params['enable_link_items_scroll'] == true) {
            $ipsClasses[] = 'mkdf-ips-with-scroll';
        }

        if(!empty($params['skin']) && $params['skin'] == 'light') {
            $ipsClasses[] = 'mkdf-ips-light';
        }
        
        return $ipsClasses;
    }

    /**
     * Filter portfolio categories
     *
     * @param $query
     *
     * @return array
     */
    public function portfolioCategoryAutocompleteSuggester( $query ) {
        global $wpdb;
        $post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS portfolio_category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'portfolio-category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );

        $results = array();
        if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
            foreach ( $post_meta_infos as $value ) {
                $data          = array();
                $data['value'] = $value['slug'];
                $data['label'] = ( ( strlen( $value['portfolio_category_title'] ) > 0 ) ? esc_html__( 'Category', 'holmes-core' ) . ': ' . $value['portfolio_category_title'] : '' );
                $results[]     = $data;
            }
        }

        return $results;
    }

    /**
     * Find portfolio category by slug
     * @since 4.4
     *
     * @param $query
     *
     * @return bool|array
     */
    public function portfolioCategoryAutocompleteRender( $query ) {
        $query = trim( $query['value'] ); // get value from requested
        if ( ! empty( $query ) ) {
            // get portfolio category
            $portfolio_category = get_term_by( 'slug', $query, 'portfolio-category' );
            if ( is_object( $portfolio_category ) ) {

                $portfolio_category_slug  = $portfolio_category->slug;
                $portfolio_category_title = $portfolio_category->name;

                $portfolio_category_title_display = '';
                if ( ! empty( $portfolio_category_title ) ) {
                    $portfolio_category_title_display = esc_html__( 'Category', 'holmes-core' ) . ': ' . $portfolio_category_title;
                }

                $data          = array();
                $data['value'] = $portfolio_category_slug;
                $data['label'] = $portfolio_category_title_display;

                return ! empty( $data ) ? $data : false;
            }

            return false;
        }

        return false;
    }

    public function getQueryArray($params){
        $query_array = array(
            'post_status'    => 'publish',
            'post_type'      => 'portfolio-item',
            'posts_per_page' => -1,
            'orderby'        => 'DATE',
            'order'          => "ASC"
        );

        if(!empty($params['category'])){
            $query_array['portfolio-category'] = $params['category'];
        }

        $query_array['paged'] = 1;

        return $query_array;
    }
}
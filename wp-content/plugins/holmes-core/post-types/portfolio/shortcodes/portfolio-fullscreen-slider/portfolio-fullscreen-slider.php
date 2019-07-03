<?php

namespace HolmesCore\CPT\Shortcodes\Portfolio;

use HolmesCore\Lib;

class PortfolioFullScreenSlider implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'mkdf_portfolio_fullscreen_slider';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
		
		//Portfolio category filter
		add_filter( 'vc_autocomplete_mkdf_portfolio_fullscreen_slider_category_callback', array( &$this, 'portfolioCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

		//Portfolio category render
		add_filter( 'vc_autocomplete_mkdf_portfolio_fullscreen_slider_category_render', array( &$this, 'portfolioCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array

		//Portfolio selected projects filter
		add_filter( 'vc_autocomplete_mkdf_portfolio_fullscreen_slider_selected_projects_callback', array( &$this, 'portfolioIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

		//Portfolio selected projects render
		add_filter( 'vc_autocomplete_mkdf_portfolio_fullscreen_slider_selected_projects_render', array( &$this, 'portfolioIdAutocompleteRender', ), 10, 1 ); // Render exact portfolio. Must return an array (label,value)

		//Portfolio tag filter
		add_filter( 'vc_autocomplete_mkdf_portfolio_fullscreen_slider_tag_callback', array( &$this, 'portfolioTagAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

		//Portfolio tag render
		add_filter( 'vc_autocomplete_mkdf_portfolio_fullscreen_slider_tag_render', array( &$this, 'portfolioTagAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'     => esc_html__( 'Portfolio Fullscreen Slider', 'holmes-core' ),
					'base'     => $this->base,
					'category' => esc_html__( 'by HOLMES', 'holmes-core' ),
					'icon'     => 'icon-wpb-portfolio-fullscreen-slider extended-custom-icon',
					'params'   => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'number_of_items',
							'heading'     => esc_html__( 'Number of Portfolios Items', 'holmes-core' ),
							'admin_label' => true,
							'description' => esc_html__( 'Set number of items for your portfolio slider. Enter -1 to show all', 'holmes-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'item_type',
							'heading'    => esc_html__( 'Click Behavior', 'holmes-core' ),
							'value'      => array(
								esc_html__( 'Open portfolio single page on click', 'holmes-core' )   => '',
								esc_html__( 'Open gallery in Pretty Photo on click', 'holmes-core' ) => 'gallery',
							)
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Number of Columns', 'holmes-core' ),
							'value'       => array(
								esc_html__( 'Default', 'holmes-core' ) => '',
								esc_html__( 'One', 'holmes-core' )     => '1',
								esc_html__( 'Two', 'holmes-core' )     => '2',
								esc_html__( 'Three', 'holmes-core' )   => '3',
								esc_html__( 'Four', 'holmes-core' )    => '4',
								esc_html__( 'Five', 'holmes-core' )    => '5'
							),
							'description' => esc_html__( 'Number of portfolios that are showing at the same time in slider (on smaller screens is responsive so there will be less items shown). Default value is Four', 'holmes-core' ),
							'save_always' => true,
							'admin_label' => true
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'item_style',
							'heading'    => esc_html__( 'Item Style', 'holmes-core' ),
							'value'      => array(
								esc_html__( 'Transparent', 'holmes-core' ) => 'fullscreen-slider',
								esc_html__( 'Boxed', 'holmes-core' )       => 'fullscreen-slider-box',
							),
							'save_always' => true,
							'group'      => esc_html__( 'Content Layout', 'holmes-core' ),
							'dependency' => array( 'element' => 'type', 'value' => array( 'masonry', 'gallery' ) )
						),
						array(
						    'type'        => 'dropdown',
                            'param_name'  => 'skin',
                            'heading'     => esc_html__( 'Skin', 'holmes-core' ),
                            'value'       => array(
                                esc_html__( 'Light', 'holmes-core') => 'mkdf-pfs-light-skin',
                                esc_html__( 'Dark', 'holmes-core') => 'mkdf-pfs-dark-skin'
                            )
                        ),
						array(
							'type'        => 'textfield',
							'param_name'  => 'subtract_from_height',
							'heading'     => esc_html__( 'Subtract from Height (px)', 'holmes-core' ),
							'description' => esc_html__( 'Subtract height from slider full height', 'holmes-core' )
						),
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'category',
							'heading'     => esc_html__( 'One-Category Portfolio List', 'holmes-core' ),
							'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'holmes-core' )
						),
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'selected_projects',
							'heading'     => esc_html__( 'Show Only Projects with Listed IDs', 'holmes-core' ),
							'settings'    => array(
								'multiple'      => true,
								'sortable'      => true,
								'unique_values' => true
							),
							'description' => esc_html__( 'Delimit ID numbers by comma (leave empty for all)', 'holmes-core' )
						),
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'tag',
							'heading'     => esc_html__( 'One-Tag Portfolio List', 'holmes-core' ),
							'description' => esc_html__( 'Enter one tag slug (leave empty for showing all tags)', 'holmes-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'orderby',
							'heading'     => esc_html__( 'Order By', 'holmes-core' ),
							'value'       => array_flip( holmes_mkdf_get_query_order_by_array() ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'order',
							'heading'     => esc_html__( 'Order', 'holmes-core' ),
							'value'       => array_flip( holmes_mkdf_get_query_order_array() ),
							'save_always' => true
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'enable_title',
							'heading'    => esc_html__( 'Enable Title', 'holmes-core' ),
							'value'      => array_flip( holmes_mkdf_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Content Layout', 'holmes-core' )
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
							'type'       => 'dropdown',
							'param_name' => 'title_text_transform',
							'heading'    => esc_html__( 'Title Text Transform', 'holmes-core' ),
							'value'      => array_flip( holmes_mkdf_get_text_transform_array( true ) ),
							'dependency' => array( 'element' => 'enable_title', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Content Layout', 'holmes-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'enable_category',
							'heading'    => esc_html__( 'Enable Category', 'holmes-core' ),
							'value'      => array_flip( holmes_mkdf_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Content Layout', 'holmes-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'enable_excerpt',
							'heading'    => esc_html__( 'Enable Excerpt', 'holmes-core' ),
							'value'      => array_flip( holmes_mkdf_get_yes_no_select_array( false ) ),
							'group'      => esc_html__( 'Content Layout', 'holmes-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'excerpt_length',
							'heading'     => esc_html__( 'Excerpt Length', 'holmes-core' ),
							'description' => esc_html__( 'Number of characters', 'holmes-core' ),
							'dependency'  => array( 'element' => 'enable_excerpt', 'value' => array( 'yes' ) ),
							'group'       => esc_html__( 'Content Layout', 'holmes-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'space_between_items',
							'value'       => array_flip( holmes_mkdf_get_space_between_items_array(true) ),
							'heading'     => esc_html__( 'Space between slides', 'holmes-core' ),
							'group'       => esc_html__( 'Slider Settings', 'holmes-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_loop',
							'heading'     => esc_html__( 'Enable Slider Loop', 'holmes-core' ),
							'value'       => array_flip( holmes_mkdf_get_yes_no_select_array( false, false ) ),
							'save_always' => true,
							'group'       => esc_html__( 'Slider Settings', 'holmes-core' ),
							'dependency'  => array( 'element' => 'item_type', 'value' => array( '' ) )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_autoplay',
							'heading'     => esc_html__( 'Enable Slider Autoplay', 'holmes-core' ),
							'value'       => array_flip( holmes_mkdf_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'group'       => esc_html__( 'Slider Settings', 'holmes-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'slider_speed',
							'heading'     => esc_html__( 'Slide Duration', 'holmes-core' ),
							'description' => esc_html__( 'Default value is 5000 (ms)', 'holmes-core' ),
							'group'       => esc_html__( 'Slider Settings', 'holmes-core' )
						)
					)
				)
			);
		}
	}

	public function render( $atts, $content = null ) {
		$args   = array(
			'number_of_items'        => '9',
			'number_of_columns'      => '3',
			'item_type'              => '',
			'item_style'             => 'fullscreen-slider',
			'skin'                   => 'mkdf-pfs-light-skin',
			'subtract_from_height'   => '',
			'category'               => '',
			'selected_projects'      => '',
			'tag'                    => '',
			'orderby'                => 'date',
			'order'                  => 'ASC',
			'enable_title'           => 'yes',
			'title_tag'              => 'h4',
			'title_text_transform'   => '',
			'enable_category'        => 'yes',
			'enable_excerpt'         => 'no',
			'excerpt_length'         => '20',
			'space_between_items'    => 'no',
			'enable_loop'            => 'no',
			'enable_autoplay'        => 'yes',
			'slider_speed'           => '5000',
            'portfolio_fullscreen_slider' => 'yes',
        );
		$params = shortcode_atts( $args, $atts );

		$params['type'] = 'gallery';
        $params['image_proportions']='full';
		$holder_style = $this->getFullScreenSliderStyles($params);
		$holder_classes = $this->getFullScreenClasses($params, $args);

		$html = '<div class="mkdf-portfolio-fullscreen-slider-holder '. $params['skin'] .' '. $holder_classes . '" ' . holmes_mkdf_get_inline_style($holder_style) . '>';
			$html .= holmes_mkdf_execute_shortcode( 'mkdf_portfolio_list', $params );
		$html .= '</div>';
		
		return $html;
	}

	private function getFullScreenSliderStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['subtract_from_height'] ) ) {
			$styles[] = 'height: calc(100vh - ' . holmes_mkdf_filter_px($params['subtract_from_height']) . 'px )';
		}

		return implode( ';', $styles );
	}


	public function getFullScreenClasses( $params, $args ) {
		$classes = array();

		$classes[] = ! empty( $params['space_between_items'] ) ? 'mkdf-' . $params['space_between_items'] . '-space' : 'mkdf-' . $args['space_between_items'] . '-space';

		return implode( ' ', $classes );
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
	
	/**
	 * Filter portfolios by ID or Title
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function portfolioIdAutocompleteSuggester( $query ) {
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
	public function portfolioIdAutocompleteRender( $query ) {
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
	 * Filter portfolio tags
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function portfolioTagAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS portfolio_tag_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'portfolio-tag' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['portfolio_tag_title'] ) > 0 ) ? esc_html__( 'Tag', 'holmes-core' ) . ': ' . $value['portfolio_tag_title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find portfolio tag by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function portfolioTagAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio category
			$portfolio_tag = get_term_by( 'slug', $query, 'portfolio-tag' );
			if ( is_object( $portfolio_tag ) ) {
				
				$portfolio_tag_slug  = $portfolio_tag->slug;
				$portfolio_tag_title = $portfolio_tag->name;
				
				$portfolio_tag_title_display = '';
				if ( ! empty( $portfolio_tag_title ) ) {
					$portfolio_tag_title_display = esc_html__( 'Tag', 'holmes-core' ) . ': ' . $portfolio_tag_title;
				}
				
				$data          = array();
				$data['value'] = $portfolio_tag_slug;
				$data['label'] = $portfolio_tag_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
}
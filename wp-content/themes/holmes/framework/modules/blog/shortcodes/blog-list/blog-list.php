<?php

namespace HolmesCore\CPT\Shortcodes\BlogList;

use HolmesCore\Lib;

class BlogList implements Lib\ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'mkdf_blog_list';

		add_action( 'vc_before_init', array( $this, 'vcMap' ) );

		//Category filter
		add_filter( 'vc_autocomplete_mkdf_blog_list_category_callback', array(
			&$this,
			'blogCategoryAutocompleteSuggester',
		), 10, 1 ); // Get suggestion(find). Must return an array

		//Category render
		add_filter( 'vc_autocomplete_mkdf_blog_list_category_render', array(
			&$this,
			'blogCategoryAutocompleteRender',
		), 10, 1 ); // Get suggestion(find). Must return an array
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(
			array(
				'name'                      => esc_html__( 'Blog List', 'holmes' ),
				'base'                      => $this->base,
				'icon'                      => 'icon-wpb-blog-list extended-custom-icon',
				'category'                  => esc_html__( 'by HOLMES', 'holmes' ),
				'allowed_container_element' => 'vc_row',
				'params'                    => array(
					//array(
					//	'type'        => 'dropdown',
					//	'param_name'  => 'type',
					//	'heading'     => esc_html__( 'Type', 'holmes' ),
					//	'value'       => array(
					//		esc_html__( 'Masonry', 'holmes' ) => 'masonry',
					//		esc_html__( 'Simple', 'holmes' )  => 'simple',
					//		esc_html__( 'Minimal', 'holmes' ) => 'minimal'
					//	),
					//	'save_always' => true
					//),
					array(
						'type'       => 'textfield',
						'param_name' => 'number_of_posts',
						'heading'    => esc_html__( 'Number of Posts', 'holmes' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'number_of_columns',
						'heading'    => esc_html__( 'Number of Columns', 'holmes' ),
						'value'      => array_flip( holmes_mkdf_get_number_of_columns_array( true ) ),
						//'dependency' => array( 'element' => 'type', 'value' => array( 'standard', 'boxed', 'masonry' ) )
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'space_between_items',
						'heading'     => esc_html__( 'Space Between Items', 'holmes' ),
						'value'       => array_flip( holmes_mkdf_get_space_between_items_array() ),
						'save_always' => true,
						//'dependency'  => array(
						//	'element' => 'type',
						//	'value'   => array( 'masonry' )
						//)
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'orderby',
						'heading'     => esc_html__( 'Order By', 'holmes' ),
						'value'       => array_flip( holmes_mkdf_get_query_order_by_array() ),
						'save_always' => true
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'order',
						'heading'     => esc_html__( 'Order', 'holmes' ),
						'value'       => array_flip( holmes_mkdf_get_query_order_array() ),
						'save_always' => true
					),
					array(
						'type'        => 'autocomplete',
						'param_name'  => 'category',
						'heading'     => esc_html__( 'Category', 'holmes' ),
						'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'holmes' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'title_tag',
						'heading'    => esc_html__( 'Title Tag', 'holmes' ),
						'value'      => array_flip( holmes_mkdf_get_title_tag( true ) ),
						'group'      => esc_html__( 'Post Info', 'holmes' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'title_transform',
						'heading'    => esc_html__( 'Title Text Transform', 'holmes' ),
						'value'      => array_flip( holmes_mkdf_get_text_transform_array( true ) ),
						'group'      => esc_html__( 'Post Info', 'holmes' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'pagination_type',
						'heading'    => esc_html__( 'Pagination Type', 'holmes' ),
						'value'      => array(
							esc_html__( 'None', 'holmes' )            => 'no-pagination',
							esc_html__( 'Standard', 'holmes' )        => 'standard-shortcodes',
							esc_html__( 'Load More', 'holmes' )       => 'load-more',
							esc_html__( 'Infinite Scroll', 'holmes' ) => 'infinite-scroll'
						),
						'group'      => esc_html__( 'Additional Features', 'holmes' )
					)
				)
			)
		);
	}

	public function render( $atts, $content = null ) {
		$default_atts = array(
			'type'                => 'masonry',
			'number_of_posts'     => '-1',
			'number_of_columns'   => 'four',
			'space_between_items' => 'normal',
			'category'            => '',
			'orderby'             => 'title',
			'order'               => 'ASC',
			'title_tag'           => 'h4',
			'title_transform'     => '',
			'pagination_type'     => 'no-pagination',
			'image_size'          => ''
		);
		$params       = shortcode_atts( $default_atts, $atts );

		$queryArray             = $this->generateQueryArray( $params );
		$query_result           = new \WP_Query( $queryArray );
		$params['query_result'] = $query_result;

		$params['holder_data']    = $this->getHolderData( $params );
		$params['holder_classes'] = $this->getHolderClasses( $params, $default_atts );
		$params['module']         = 'list';
		$params['image_size']     = $params['type'] == 'simple' ? array( '70', '70' ) : '';

		$params['max_num_pages'] = $query_result->max_num_pages;
		$params['paged']         = isset( $query_result->query['paged'] ) ? $query_result->query['paged'] : 1;

		$params['this_object'] = $this;

		//var_dump( $params['image_size'] );

		ob_start();

		holmes_mkdf_get_module_template_part( 'shortcodes/blog-list/holder', 'blog', $params['type'], $params );

		$html = ob_get_contents();

		ob_end_clean();

		return $html;
	}

	public function getHolderClasses( $params, $default_atts ) {
		$holderClasses = array();

		$holderClasses[] = ! empty( $params['type'] ) ? 'mkdf-bl-' . $params['type'] : 'mkdf-bl-' . $default_atts['type'];
		$holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'mkdf-' . $params['number_of_columns'] . '-columns' : 'mkdf-' . $default_atts['number_of_columns'] . '-columns';
		$holderClasses[] = ! empty( $params['space_between_items'] ) ? 'mkdf-' . $params['space_between_items'] . '-space' : 'mkdf-' . $default_atts['space_between_items'] . '-space';
		$holderClasses[] = ! empty( $params['pagination_type'] ) ? 'mkdf-bl-pag-' . $params['pagination_type'] : 'mkdf-bl-pag-' . $default_atts['pagination_type'];

		return implode( ' ', $holderClasses );
	}

	public function getHolderData( $params ) {
		$dataString = '';

		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}

		$query_result = $params['query_result'];

		$params['max_num_pages'] = $query_result->max_num_pages;

		if ( ! empty( $paged ) ) {
			$params['next-page'] = $paged + 1;
		}

		foreach ( $params as $key => $value ) {
			if ( $key !== 'query_result' && $value !== '' ) {
				$new_key = str_replace( '_', '-', $key );

				$dataString .= ' data-' . $new_key . '=' . esc_attr( str_replace( ' ', '', $value ) );
			}
		}

		return $dataString;
	}

	public function generateQueryArray( $params ) {
		$queryArray = array(
			'post_status'    => 'publish',
			'post_type'      => 'post',
			'orderby'        => $params['orderby'],
			'order'          => $params['order'],
			'posts_per_page' => $params['number_of_posts'],
			'post__not_in'   => get_option( 'sticky_posts' )
		);

		if ( ! empty( $params['category'] ) ) {
			$queryArray['category_name'] = $params['category'];
		}

		if ( ! empty( $params['next_page'] ) ) {
			$queryArray['paged'] = $params['next_page'];
		} else {
			$query_array['paged'] = 1;
		}

		return $queryArray;
	}

	public function getTitleStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['title_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['title_transform'];
		}

		return implode( ';', $styles );
	}

	/**
	 * Filter blog categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function blogCategoryAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['category_title'] ) > 0 ) ? esc_html__( 'Category', 'holmes' ) . ': ' . $value['category_title'] : '' );
				$results[]     = $data;
			}
		}

		return $results;
	}

	/**
	 * Find blog category by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function blogCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio category
			$category = get_term_by( 'slug', $query, 'category' );
			if ( is_object( $category ) ) {

				$category_slug  = $category->slug;
				$category_title = $category->name;

				$category_title_display = '';
				if ( ! empty( $category_title ) ) {
					$category_title_display = esc_html__( 'Category', 'holmes' ) . ': ' . $category_title;
				}

				$data          = array();
				$data['value'] = $category_slug;
				$data['label'] = $category_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}
}
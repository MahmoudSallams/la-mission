<?php

if ( ! function_exists( 'holmes_core_portfolio_meta_box_functions' ) ) {
	function holmes_core_portfolio_meta_box_functions( $post_types ) {
		$post_types[] = 'portfolio-item';

		return $post_types;
	}

	add_filter( 'holmes_mkdf_meta_box_post_types_save', 'holmes_core_portfolio_meta_box_functions' );
	add_filter( 'holmes_mkdf_meta_box_post_types_remove', 'holmes_core_portfolio_meta_box_functions' );
}

if ( ! function_exists( 'holmes_core_portfolio_scope_meta_box_functions' ) ) {
	function holmes_core_portfolio_scope_meta_box_functions( $post_types ) {
		$post_types[] = 'portfolio-item';

		return $post_types;
	}

	add_filter( 'holmes_mkdf_set_scope_for_meta_boxes', 'holmes_core_portfolio_scope_meta_box_functions' );
}

if ( ! function_exists( 'holmes_core_portfolio_add_social_share_option' ) ) {
	function holmes_core_portfolio_add_social_share_option( $container ) {
		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_social_share_on_portfolio_item',
				'default_value' => 'no',
				'label'         => esc_html__( 'Portfolio Item', 'holmes-core' ),
				'description'   => esc_html__( 'Show Social Share for Portfolio Items', 'holmes-core' ),
				'parent'        => $container
			)
		);
	}

	add_action( 'holmes_mkdf_post_types_social_share', 'holmes_core_portfolio_add_social_share_option', 10, 1 );
}

if ( ! function_exists( 'holmes_core_register_portfolio_cpt' ) ) {
	function holmes_core_register_portfolio_cpt( $cpt_class_name ) {
		$cpt_class = array(
			'HolmesCore\CPT\Portfolio\PortfolioRegister'
		);

		$cpt_class_name = array_merge( $cpt_class_name, $cpt_class );

		return $cpt_class_name;
	}

	add_filter( 'holmes_core_filter_register_custom_post_types', 'holmes_core_register_portfolio_cpt' );
}

if ( ! function_exists( 'holmes_core_get_archive_portfolio_list' ) ) {
	function holmes_core_get_archive_portfolio_list( $holmes_taxonomy_slug = '', $holmes_taxonomy_name = '' ) {

		$number_of_items        = 12;
		$number_of_items_option = holmes_mkdf_options()->getOptionValue( 'portfolio_archive_number_of_items' );
		if ( ! empty( $number_of_items_option ) ) {
			$number_of_items = $number_of_items_option;
		}

		$number_of_columns        = 'four';
		$number_of_columns_option = holmes_mkdf_options()->getOptionValue( 'portfolio_archive_number_of_columns' );
		if ( ! empty( $number_of_columns_option ) ) {
			$number_of_columns = $number_of_columns_option;
		}

		$space_between_items        = 'normal';
		$space_between_items_option = holmes_mkdf_options()->getOptionValue( 'portfolio_archive_space_between_items' );
		if ( ! empty( $space_between_items_option ) ) {
			$space_between_items = $space_between_items_option;
		}

		$image_size        = 'landscape';
		$image_size_option = holmes_mkdf_options()->getOptionValue( 'portfolio_archive_image_size' );
		if ( ! empty( $image_size_option ) ) {
			$image_size = $image_size_option;
		}

		$item_style         = 'standard-shader';
		$item_layout_option = holmes_mkdf_options()->getOptionValue( 'portfolio_archive_item_layout' );
		if ( ! empty( $item_layout_option ) ) {
			$item_style = $item_layout_option;
		}

		$category = $holmes_taxonomy_name === 'portfolio-category' && ! empty( $holmes_taxonomy_slug ) ? $holmes_taxonomy_slug : '';
		$tag      = $holmes_taxonomy_name === 'portfolio-tag' && ! empty( $holmes_taxonomy_slug ) ? $holmes_taxonomy_slug : '';

		$params = array(
			'type'                => 'gallery',
			'number_of_items'     => $number_of_items,
			'number_of_columns'   => $number_of_columns,
			'space_between_items' => $space_between_items,
			'image_proportions'   => $image_size,
			'category'            => $category,
			'tag'                 => $tag,
			'item_style'          => $item_style,
			'pagination_type'     => 'load-more'
		);

		$html = holmes_mkdf_execute_shortcode( 'mkdf_portfolio_list', $params );

		print holmes_mkdf_get_clean_output($html);
	}
}

// Load portfolio shortcodes
if ( ! function_exists( 'holmes_core_include_portfolio_shortcodes_files' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function holmes_core_include_portfolio_shortcodes_files() {
		foreach ( glob( HOLMES_CORE_CPT_PATH . '/portfolio/shortcodes/*/load.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
	}

	add_action( 'holmes_core_action_include_shortcodes_file', 'holmes_core_include_portfolio_shortcodes_files' );
}

if ( ! function_exists( 'holmes_core_set_portfolio_single_info_follow_body_class' ) ) {
	/**
	 * Function that adds follow portfolio info class to body if sticky sidebar is enabled on portfolio single layouts
	 *
	 * @param $classes array of body classes
	 *
	 * @return array with follow portfolio info class body class added
	 */
	function holmes_core_set_portfolio_single_info_follow_body_class( $classes ) {
		if ( is_singular( 'portfolio-item' ) && holmes_mkdf_options()->getOptionValue( 'portfolio_single_sticky_sidebar' ) == 'yes' ) {
			$classes[] = 'mkdf-follow-portfolio-info';
		}

		return $classes;
	}

	add_filter( 'body_class', 'holmes_core_set_portfolio_single_info_follow_body_class' );
}

if ( ! function_exists( 'holmes_core_single_portfolio_title_display' ) ) {
	/**
	 * Function that checks option for single portfolio title and overrides it with filter
	 */
	function holmes_core_single_portfolio_title_display( $show_title_area ) {
		if ( is_singular( 'portfolio-item' ) ) {
			//Override displaying title based on portfolio option
			$show_title_area_meta = holmes_mkdf_get_meta_field_intersect( 'show_title_area_portfolio_single' );

			if ( ! empty( $show_title_area_meta ) ) {
				$show_title_area = $show_title_area_meta == 'yes' ? true : false;
			}
		}

		return $show_title_area;
	}

	add_filter( 'holmes_mkdf_show_title_area', 'holmes_core_single_portfolio_title_display' );
}

if ( ! function_exists( 'holmes_core_set_breadcrumbs_output_for_portfolio' ) ) {
	function holmes_core_set_breadcrumbs_output_for_portfolio( $childContent, $delimiter, $before, $after ) {

		if ( is_tax( 'portfolio-category' ) || is_tax( 'portfolio-tag' ) ) {
			$childContent = '';

			$holmes_taxonomy_id        = get_queried_object_id();
			$holmes_taxonomy_type      = is_tax( 'portfolio-tag' ) ? 'portfolio-tag' : 'portfolio-category';
			$holmes_taxonomy           = ! empty( $holmes_taxonomy_id ) ? get_term_by( 'id', $holmes_taxonomy_id, $holmes_taxonomy_type ) : '';
			$holmes_taxonomy_parent_id = isset( $holmes_taxonomy->parent ) && $holmes_taxonomy->parent !== 0 ? $holmes_taxonomy->parent : '';
			$holmes_taxonomy_parent    = $holmes_taxonomy_parent_id !== '' ? get_term_by( 'id', $holmes_taxonomy_parent_id, $holmes_taxonomy_type ) : '';

			if ( ! empty( $holmes_taxonomy_parent ) ) {
				$childContent .= '<a itemprop="url" href="' . get_term_link( $holmes_taxonomy_parent->term_id ) . '">' . $holmes_taxonomy_parent->name . '</a>' . $delimiter;
			}

			if ( ! empty( $holmes_taxonomy ) ) {
				$childContent .= $before . esc_attr( $holmes_taxonomy->name ) . $after;
			}

		} elseif ( is_singular( 'portfolio-item' ) ) {
			$portfolio_categories = wp_get_post_terms( holmes_mkdf_get_page_id(), 'portfolio-category' );
			$childContent         = '';

			if ( ! empty( $portfolio_categories ) && count( $portfolio_categories ) ) {
				foreach ( $portfolio_categories as $cat ) {
					$childContent .= '<a itemprop="url" href="' . get_term_link( $cat->term_id ) . '">' . $cat->name . '</a>' . $delimiter;
				}
			}

			$childContent .= $before . get_the_title() . $after;
		}

		return $childContent;
	}

	add_filter( 'holmes_mkdf_breadcrumbs_title_child_output', 'holmes_core_set_breadcrumbs_output_for_portfolio', 10, 4 );
}

if ( ! function_exists( 'holmes_core_set_single_portfolio_comments_enabled' ) ) {
	function holmes_core_set_single_portfolio_comments_enabled( $comments ) {
		if ( is_singular( 'portfolio-item' ) && holmes_mkdf_options()->getOptionValue( 'portfolio_single_comments' ) == 'yes' ) {
			$comments = true;
		}

		return $comments;
	}

	add_filter( 'holmes_mkdf_post_type_comments', 'holmes_core_set_single_portfolio_comments_enabled', 10, 1 );
}

if ( ! function_exists( 'holmes_core_get_single_portfolio' ) ) {
	function holmes_core_get_single_portfolio() {
		$portfolio_template = holmes_mkdf_get_meta_field_intersect( 'portfolio_single_template' );

		$params = array(
			'holder_classes' => 'mkdf-ps-' . $portfolio_template . '-layout',
			'item_layout'    => $portfolio_template
		);

		holmes_core_get_cpt_single_module_template_part( 'templates/single/holder', 'portfolio', $portfolio_template, $params );
	}
}

if ( ! function_exists( 'holmes_core_set_single_portfolio_style' ) ) {
	/**
	 * Function that return padding for content
	 */
	function holmes_core_set_single_portfolio_style( $style ) {
		$page_id      = holmes_mkdf_get_page_id();
		$class_prefix = holmes_mkdf_get_unique_page_class( $page_id );

		$current_styles = '';
		$current_style  = array();

		$current_selector = array(
			$class_prefix . ' .mkdf-portfolio-single-holder .mkdf-ps-info-holder'
		);

		$info_padding_top = get_post_meta( $page_id, 'portfolio_info_top_padding', true );

		if ( ! empty( $info_padding_top ) ) {
			$current_style['margin-top'] = holmes_mkdf_filter_px( $info_padding_top ) . 'px';

			$current_styles .= holmes_mkdf_dynamic_css( $current_selector, $current_style );
		}

		$current_style = $current_styles . $style;

		return $current_style;
	}

	add_filter( 'holmes_mkdf_add_page_custom_style', 'holmes_core_set_single_portfolio_style' );
}

if ( ! function_exists( 'holmes_core_add_portfolio_attachment_custom_field' ) ) {
	function holmes_core_add_portfolio_attachment_custom_field( $form_fields, $post = null ) {
		if ( wp_attachment_is_image( $post->ID ) ) {
			$field_value = get_post_meta( $post->ID, 'portfolio_single_masonry_image_size', true );

			$form_fields['portfolio_single_masonry_image_size'] = array(
				'input' => 'html',
				'label' => esc_html__( 'Image Size', 'holmes-core' ),
				'helps' => esc_html__( 'Choose image size for portfolio single item - Masonry layout', 'holmes-core' )
			);

			$form_fields['portfolio_single_masonry_image_size']['html'] = "<select name='attachments[{$post->ID}][portfolio_single_masonry_image_size]'>";
			$form_fields['portfolio_single_masonry_image_size']['html'] .= '<option ' . selected( $field_value, '', false ) . ' value="">' . esc_html__( 'Default', 'holmes-core' ) . '</option>';
			$form_fields['portfolio_single_masonry_image_size']['html'] .= '<option ' . selected( $field_value, 'small', false ) . ' value="small">' . esc_html__( 'Small', 'holmes-core' ) . '</option>';
			$form_fields['portfolio_single_masonry_image_size']['html'] .= '<option ' . selected( $field_value, 'large-width', false ) . ' value="large-width">' . esc_html__( 'Large Width', 'holmes-core' ) . '</option>';
			$form_fields['portfolio_single_masonry_image_size']['html'] .= '<option ' . selected( $field_value, 'large-height', false ) . ' value="large-height">' . esc_html__( 'Large Height', 'holmes-core' ) . '</option>';
			$form_fields['portfolio_single_masonry_image_size']['html'] .= '<option ' . selected( $field_value, 'large-width-height', false ) . ' value="large-width-height">' . esc_html__( 'Large Width Height', 'holmes-core' ) . '</option>';
			$form_fields['portfolio_single_masonry_image_size']['html'] .= '</select>';
		}

		return $form_fields;
	}

	add_filter( 'attachment_fields_to_edit', 'holmes_core_add_portfolio_attachment_custom_field', 10, 2 );
}

if ( ! function_exists( 'holmes_core_save_image_portfolio_attachment_fields' ) ) {
	/**
	 * @param array $post
	 * @param array $attachment
	 *
	 * @return array
	 */
	function holmes_core_save_image_portfolio_attachment_fields( $post, $attachment ) {

		if ( isset( $attachment['portfolio_single_masonry_image_size'] ) ) {
			update_post_meta( $post['ID'], 'portfolio_single_masonry_image_size', $attachment['portfolio_single_masonry_image_size'] );
		}

		return $post;
	}

	add_filter( 'attachment_fields_to_save', 'holmes_core_save_image_portfolio_attachment_fields', 10, 2 );
}

if ( ! function_exists( 'holmes_core_get_portfolio_single_media' ) ) {
	/*
     * @param boolean $masonry - set it manually when calling function from port single masonry templates,
     *                           used to crop images only for port single masonry layouts
     */
	function holmes_core_get_portfolio_single_media( $masonry = false ) {
		$image_ids       = get_post_meta( get_the_ID(), 'mkdf-portfolio-image-gallery', true );
		$single_upload   = get_post_meta( get_the_ID(), 'mkdf_portfolio_single_upload', true );
		$portfolio_media = array();

		if ( $image_ids !== '' ) {
			$image_ids = explode( ',', $image_ids );

			foreach ( $image_ids as $image_id ) {
				$media                   = array();
				$media['title']          = get_the_title( $image_id );
				$media['type']           = 'image';
				$media['description']    = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
				$media['image_src']      = wp_get_attachment_image_src( $image_id, 'full' );
				$media['holder_classes'] = '';

				$image_size = get_post_meta( $image_id, 'portfolio_single_masonry_image_size', true );

				// if image size for port single masonry layout is set and function is called from masonry layout template
				if ( ! empty ( $image_size ) && $masonry === true ) {
					switch ( $image_size ) {
						case 'small':
							$media['image_src'] = wp_get_attachment_image_src( $image_id, 'holmes_mkdf_square' );
							break;
						case 'large-width':
							$media['image_src'] = wp_get_attachment_image_src( $image_id, 'holmes_mkdf_landscape' );
							break;
						case 'large-height':
							$media['image_src'] = wp_get_attachment_image_src( $image_id, 'holmes_mkdf_portrait' );
							break;
						case 'large-width-height':
							$media['image_src'] = wp_get_attachment_image_src( $image_id, 'holmes_mkdf_huge' );
							break;
					}

					$media['holder_classes'] = 'mkdf-masonry-size-' . esc_attr( $image_size );
				}

				$portfolio_media[] = $media;
			}
		}

		if ( is_array( $single_upload ) && count( $single_upload ) ) {
			foreach ( $single_upload as $item ) {
				$media = array();

				if ( $item['file_type'] == 'video' ) {
					$media['type']        = $item['video_type'];
					$media['description'] = 'video';
					$media['video_url']   = holmes_core_get_portfolio_video_url( $item );

					if ( $item['video_type'] == 'self' ) {
						$media['video_cover'] = ! empty( $item['video_cover_image'] ) ? $item['video_cover_image'] : '';
					}

					if ( $item['video_type'] !== 'self' ) {
						$media['video_id'] = $item['video_id'];
					}
				} elseif ( $item['file_type'] == 'image' ) {
					$media['type']      = 'image';
					$media['image_src'] = $item['single_image'];
				}

				//fallback if description is not set for media
				$media['title'] = get_the_title();

				$portfolio_media[] = $media;
			}
		}

		return $portfolio_media;
	}
}

if ( ! function_exists( 'holmes_core_get_portfolio_video_url' ) ) {
	function holmes_core_get_portfolio_video_url( $video ) {
		switch ( $video['video_type'] ) {
			case 'youtube':
				return 'https://youtube.com/watch?v=' . $video['video_id'];
				break;
			case 'vimeo';
				return 'https://vimeo.com/' . $video['video_id'];
				break;
			case 'self':
				$return_array = array();

				if ( ! empty( $video['video_mp4'] ) ) {
					$return_array['mp4'] = $video['video_mp4'];
				}

				return $return_array;

				break;
		}
	}
}

if ( ! function_exists( 'holmes_core_get_portfolio_single_media_html' ) ) {
	function holmes_core_get_portfolio_single_media_html( $media ) {
		$params = array();

		if ( $media['type'] == 'image' ) {
			$params['lightbox'] = holmes_mkdf_options()->getOptionValue( 'portfolio_single_lightbox_images' ) == 'yes';

			$media['image_url'] = is_array( $media['image_src'] ) ? $media['image_src'][0] : $media['image_src'];
			if ( empty( $media['description'] ) ) {
				$media['description'] = $media['title'];
			}
		}

		if ( in_array( $media['type'], array( 'youtube', 'vimeo' ) ) ) {
			$params['lightbox'] = holmes_mkdf_options()->getOptionValue( 'portfolio_single_lightbox_videos' ) == 'yes';

			if ( $params['lightbox'] ) {
				switch ( $media['type'] ) {
					case 'vimeo':
						$url      = 'https://vimeo.com/api/v2/video/' . $media['video_id'] . '.php';
						$request  = wp_remote_get( $url );
						$response = unserialize( wp_remote_retrieve_body( $request ) );

						$params['video_title']    = $response[0]['title'];
						$params['lightbox_thumb'] = $response[0]['thumbnail_large'];
						break;
					case 'youtube':
						$params['video_title'] = $media['title'];

						$params['lightbox_thumb'] = 'https://img.youtube.com/vi/' . trim( $media['video_id'] ) . '/sddefault.jpg';
						break;
				}
			}
		}

		$params['media'] = $media;

		holmes_core_get_cpt_single_module_template_part( 'templates/single/media/' . $media['type'], 'portfolio', '', $params );
	}
}

if ( ! function_exists( 'holmes_core_get_portfolio_single_related_posts' ) ) {
	/**
	 * Function for returning portfolio single related posts
	 *
	 * @param $post_id
	 *
	 * @return WP_Query
	 */
	function holmes_core_get_portfolio_single_related_posts( $post_id ) {
		//Get tags
		$tags = wp_get_object_terms( $post_id, 'portfolio-tag' );

		//Get categories
		$categories = wp_get_object_terms( $post_id, 'portfolio-category' );

		$tag_ids = array();
		if ( $tags ) {
			foreach ( $tags as $tag ) {
				$tag_ids[] = $tag->term_id;
			}
		}

		$category_ids = array();
		if ( $categories ) {
			foreach ( $categories as $category ) {
				$category_ids[] = $category->term_id;
			}
		}

		$hasRelatedByTag = false;

		if ( $tag_ids ) {
			$related_by_tag = holmes_core_get_portfolio_single_related_posts_by_param( $post_id, $tag_ids, 'portfolio-tag' );

			if ( ! empty( $related_by_tag->posts ) ) {
				$hasRelatedByTag = true;

				return $related_by_tag;
			}
		}

		if ( $categories && ! $hasRelatedByTag ) {
			$related_by_category = holmes_core_get_portfolio_single_related_posts_by_param( $post_id, $category_ids, 'portfolio-category' );

			if ( ! empty( $related_by_category->posts ) ) {
				return $related_by_category;
			}
		}
	}
}

if ( ! function_exists( 'holmes_core_get_portfolio_single_related_posts_by_param' ) ) {
	/**
	 * @param $post_id - Post ID
	 * @param $term_ids - Category or Tag IDs
	 * @param $taxonomy
	 *
	 * @return WP_Query
	 */
	function holmes_core_get_portfolio_single_related_posts_by_param( $post_id, $term_ids, $taxonomy ) {
		$args = array(
			'post_status'    => 'publish',
			'post__not_in'   => array( $post_id ),
			'order'          => 'DESC',
			'orderby'        => 'date',
			'posts_per_page' => '4',
			'tax_query'      => array(
				array(
					'taxonomy' => $taxonomy,
					'field'    => 'term_id',
					'terms'    => $term_ids,
				),
			)
		);

		$related_by_taxonomy = new WP_Query( $args );

		return $related_by_taxonomy;
	}
}

if ( ! function_exists( 'holmes_core_add_portfolio_to_search_types' ) ) {
	function holmes_core_add_portfolio_to_search_types( $post_types ) {

		$post_types['portfolio-item'] = esc_html__( 'Portfolio', 'holmes-core' );

		return $post_types;
	}

	add_filter( 'holmes_mkdf_search_post_type_widget_params_post_type', 'holmes_core_add_portfolio_to_search_types' );
}

/**
 * Loads more function for portfolio.
 */
if ( ! function_exists( 'holmes_core_portfolio_ajax_load_more' ) ) {
	function holmes_core_portfolio_ajax_load_more() {
		$shortcode_params = array();

		if ( ! empty( $_POST ) ) {
			foreach ( $_POST as $key => $value ) {
				if ( $key !== '' ) {
					$addUnderscoreBeforeCapitalLetter = preg_replace( '/([A-Z])/', '_$1', $key );
					$setAllLettersToLowercase         = strtolower( $addUnderscoreBeforeCapitalLetter );

					$shortcode_params[ $setAllLettersToLowercase ] = $value;
				}
			}
		}

		$port_list = new \HolmesCore\CPT\Shortcodes\Portfolio\PortfolioList();

		$query_array                     = $port_list->getQueryArray( $shortcode_params );
		$query_results                   = new \WP_Query( $query_array );
		$shortcode_params['this_object'] = $port_list;

		$html = '';
		if ( $query_results->have_posts() ):
			while ( $query_results->have_posts() ) : $query_results->the_post();
				$html .= holmes_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-list', 'portfolio-item', $shortcode_params['item_type'], $shortcode_params );
			endwhile;
		else:
			$html .= holmes_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-list', 'parts/posts-not-found', '', $shortcode_params );
		endif;

		wp_reset_postdata();

		$return_obj = array(
			'html' => $html,
		);

		echo json_encode( $return_obj );
		exit;
	}
}

add_action( 'wp_ajax_nopriv_holmes_core_portfolio_ajax_load_more', 'holmes_core_portfolio_ajax_load_more' );
add_action( 'wp_ajax_holmes_core_portfolio_ajax_load_more', 'holmes_core_portfolio_ajax_load_more' );

if ( ! function_exists( 'holmes_core_admin_filter_taxonomies' ) ) {
	/*
	 * add taxonomy filters in admin portfolio list
	 */
	function holmes_core_admin_filter_taxonomies() {
		global $typenow;

		// an array of all the taxonomies to display
		$taxonomies = array( 'portfolio-category', 'portfolio-tag' );

		// use the custom post type here
		if ( $typenow === 'portfolio-item' ) {
			foreach ( $taxonomies as $taxonomy ) {
				$taxonomy_obj = get_taxonomy( $taxonomy );
				wp_dropdown_categories( array(
					'show_option_all' => sprintf( __( 'All %s', 'holmes-core' ), $taxonomy_obj->label ),
					'orderby'         => 'name',
					'order'           => 'ASC',
					'hide_empty'      => true,
					'hide_if_empty'   => true,
					'selected'        => filter_input( INPUT_GET, $taxonomy_obj->query_var, FILTER_SANITIZE_STRING ),
					'hierarchical'    => true,
					'name'            => $taxonomy_obj->query_var,
					'taxonomy'        => $taxonomy_obj->name,
					'value_field'     => 'slug',
				) );
			}
		}
	}

	add_action( 'restrict_manage_posts', 'holmes_core_admin_filter_taxonomies' );
}

if ( ! function_exists( 'holmes_core_portfolio_page_navigation' ) ) {
	function holmes_core_portfolio_page_navigation() {
		$html = '';

		if ( is_singular( 'portfolio-item' ) ):

			$nav_same_category = holmes_mkdf_options()->getOptionValue( 'portfolio_single_nav_same_category' ) == 'yes';

			$arrow_left  = file_get_contents( HOLMES_CORE_ASSETS_PATH . '/svgs/arrow-left.php' );
			$arrow_right = file_get_contents( HOLMES_CORE_ASSETS_PATH . '/svgs/arrow-right.php' );

			$html .= '<div class="mkdf-ps-page-navigation">';
			if ( get_previous_post() !== '' ) {
				$html .= '<div class="mkdf-ps-prev">';
				if ( $nav_same_category ) {
					$html .= get_previous_post_link( '%link', '<span>' . $arrow_left . '</span>
                    <div class="mkdf-ps-nav-img" style="background-image: url(' . get_the_post_thumbnail_url( get_previous_post( true )->ID ) . ')"></div><div class="mkdf-ps-title-holder">' . get_previous_post( true )->post_title . '</div></div>', true, '', 'portfolio-category' );
				} else {
					$html .= get_previous_post_link( '%link', '<span>' . $arrow_left . '</span>
                    <div class="mkdf-ps-content-holder"><div class="mkdf-ps-nav-img" style="background-image: url(' . get_the_post_thumbnail_url( get_previous_post()->ID ) . ')"></div><div class="mkdf-ps-title-holder">' . get_previous_post()->post_title . '</div></div>' );
				}
				$html .= '</div>';
			}
			if ( get_next_post() !== '' ) {
				$html .= '<div class="mkdf-ps-next">';
				if ( $nav_same_category ) {
					$html .= get_next_post_link( '%link', '<span>' . $arrow_right . '</span>
                    <div class="mkdf-ps-content-holder"><div class="mkdf-ps-nav-img" style="background-image: url(' . get_the_post_thumbnail_url( get_next_post( true )->ID ) . ')"></div><div class="mkdf-ps-title-holder">' . get_next_post( true )->post_title . '</div></div>', true, '', 'portfolio-category' );
				} else {
					$html .= get_next_post_link( '%link', '<span>' . $arrow_right . '</span>
                    <div class="mkdf-ps-content-holder"><div class="mkdf-ps-nav-img" style="background-image: url(' . get_the_post_thumbnail_url( get_next_post()->ID ) . ')"></div><div class="mkdf-ps-title-holder">' . get_next_post()->post_title . '</div></div>' );
				}
				$html .= '</div>';
			}
			$html .= '</div>';

		endif;

		echo holmes_mkdf_get_clean_output($html);
	}

	add_action( 'holmes_mkdf_portfolio_page_navigation', 'holmes_core_portfolio_page_navigation' );
	add_action( 'holmes_mkdf_portfolio_page_after_content', 'holmes_core_portfolio_page_navigation' );
}

if ( ! function_exists( 'holmes_core_has_protfolio_scrolling_body_class' ) ) {

	function holmes_core_has_protfolio_scrolling_body_class( $classes ) {
		if ( holmes_mkdf_has_shortcode( 'mkdf_horizontally_scrolling_portfolio_list' ) ) {
			$classes[] = 'mkdf-horizontally-scrolling-portfolio-list-page';
		}

		return $classes;
	}

	add_filter( 'body_class', 'holmes_core_has_protfolio_scrolling_body_class' );
}
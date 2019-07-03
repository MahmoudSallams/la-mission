<?php

if ( ! function_exists( 'holmes_mkdf_include_title_types_before_load' ) ) {
	/**
	 * Load's all title types before load files by going through all folders that are placed directly in title types folder.
	 * Functions from this files before-load are used to set all hooks and variables before global options map are init
	 */
	function holmes_mkdf_include_title_types_before_load() {
		foreach ( glob( MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/before-load.php' ) as $module_load ) {
			include_once $module_load;
		}
	}

	add_action( 'holmes_mkdf_options_map', 'holmes_mkdf_include_title_types_before_load', 1 ); // 1 is set to just be before title option map init
}

if ( ! function_exists( 'holmes_mkdf_include_title_types' ) ) {
	/**
	 * Load's all title types by going through all folders that are placed directly in title types folder
	 */
	function holmes_mkdf_include_title_types() {
		foreach ( glob( MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/load.php' ) as $module_load ) {
			include_once $module_load;
		}
	}

	add_action( 'holmes_mkdf_options_map', 'holmes_mkdf_include_title_types', 1 ); // 1 is set to just be before title option map init
}

if ( ! function_exists( 'holmes_mkdf_get_title' ) ) {
	/**
	 * Loads title area template
	 */
	function holmes_mkdf_get_title() {
		$page_id              = holmes_mkdf_get_page_id();
		$show_title_area_meta = holmes_mkdf_get_meta_field_intersect( 'show_title_area', $page_id ) == 'yes' ? true : false;
		$show_title_area      = apply_filters( 'holmes_mkdf_show_title_area', $show_title_area_meta );

		if ( $show_title_area ) {
			$type_meta = holmes_mkdf_get_meta_field_intersect( 'title_area_type', $page_id );

			$type = ! empty( $type_meta ) ? $type_meta : 'standard';
			if ( is_tax( 'portfolio-tag' ) || is_tax( 'portfolio-category' ) ) {
				$type = 'breadcrumbs';
			}

			$template_path = apply_filters( 'holmes_mkdf_title_template_path', $template_path = 'types/' . $type . '/templates/' . $type . '-title' );
			$module        = apply_filters( 'holmes_mkdf_title_module', $module = 'title' );
			$layout        = apply_filters( 'holmes_mkdf_title_layout', $layout = '' );

			$title_tag_meta = holmes_mkdf_get_meta_field_intersect( 'title_area_title_tag', $page_id );
			$title_tag      = ! empty( $title_tag_meta ) ? $title_tag_meta : 'h1';

			$subtitle_tag_meta = holmes_mkdf_get_meta_field_intersect( 'title_area_subtitle_tag', $page_id );
			$subtitle_tag      = ! empty( $subtitle_tag_meta ) ? $subtitle_tag_meta : 'h6';

			$title_number = '';
			$title_text   = '';

			if ( is_singular( array( 'portfolio-item' ) ) ) { // portfolio
				$title_number .= get_the_time( get_option( 'date_format' ) );
				$title_text   .= esc_html__( 'Portfolio', 'holmes' );
			} elseif ( is_singular( array( 'product' ) ) ) { // product
				$title_number .= $page_id . '.';
				$title_text   .= esc_html__( 'Product', 'holmes' );
			} elseif ( is_page() ) { // page
				$title_number .= $page_id . '.';
				$title_text   .= esc_html__( 'This page is for', 'holmes' );
			} elseif ( is_single() ) { // post
				$title_number .= get_the_time( get_option( 'date_format' ) );
				foreach ( get_the_category( $page_id ) as $cat ) {
					$title_text .= '<a class="mkdf-title-cat" href="' . get_category_link( $cat->cat_ID ) . '">' . $cat->name . '</a>';
				}
			}

			$parameters = array(
				'holder_classes'  => holmes_mkdf_get_title_holder_classes(),
				'holder_styles'   => holmes_mkdf_get_title_holder_styles(),
				'holder_data'     => holmes_mkdf_get_title_holder_data(),
				'wrapper_styles'  => holmes_mkdf_get_title_wrapper_styles(),
				'title_number'    => $title_number,
				'title_text'      => $title_text,
				'title_image'     => holmes_mkdf_get_title_background_image(),
				'title'           => holmes_mkdf_get_title_text(),
				'title_tag'       => $title_tag,
				'title_styles'    => holmes_mkdf_get_title_styles(),
				'subtitle'        => holmes_mkdf_subtitle_text(),
				'subtitle_tag'    => $subtitle_tag,
				'subtitle_styles' => holmes_mkdf_get_subtitle_styles(),
			);

			$parameters = apply_filters( 'holmes_mkdf_title_area_params', $parameters );

			holmes_mkdf_get_module_template_part( $template_path, $module, $layout, $parameters );
		}
	}
}

if ( ! function_exists( 'holmes_mkdf_get_title_holder_classes' ) ) {
	/**
	 * Function that adds classes to title holder div
	 */
	function holmes_mkdf_get_title_holder_classes() {
		$page_id         = holmes_mkdf_get_page_id();
		$title_type_meta = holmes_mkdf_get_meta_field_intersect( 'title_area_type', $page_id );

		$title_type = ! empty( $title_type_meta ) ? $title_type_meta : 'standard';
		if ( is_tax( 'portfolio-tag' ) || is_tax( 'portfolio-category' ) ) {
			$title_type = 'breadcrumbs';
		}

		$title_in_grid_meta       = holmes_mkdf_get_meta_field_intersect( 'title_area_in_grid', $page_id );
		$title_img                = holmes_mkdf_get_meta_field_intersect( 'title_area_background_image', $page_id );
		$title_img_behavior       = holmes_mkdf_get_meta_field_intersect( 'title_area_background_image_behavior', $page_id );
		$title_vertical_alignment = holmes_mkdf_get_meta_field_intersect( 'title_area_vertical_alignment', $page_id );
		$title_full_height        = holmes_mkdf_get_meta_field_intersect( 'title_area_full_height', $page_id );
		$title_pattern            = holmes_mkdf_get_meta_field_intersect( 'title_area_pattern', $page_id );

		$classes = array();

		$classes[] = 'mkdf-' . $title_type . '-type';

		if ( $title_in_grid_meta === 'no' ) {
			$classes[] = 'mkdf-title-full-width';
		}

		if ( ! empty( $title_vertical_alignment ) ) {
			$classes[] = 'mkdf-title-va-' . $title_vertical_alignment;
		}

		if ( ! empty( $title_img ) && $title_img_behavior !== 'hide' ) {
			$classes[] = 'mkdf-preload-background';
			$classes[] = 'mkdf-has-bg-image';

			if ( ! empty( $title_img_behavior ) ) {
				$classes[] = 'mkdf-bg-' . $title_img_behavior;
			}

			if ( $title_img_behavior === 'parallax-zoom-out' ) {
				$classes[] = 'mkdf-bg-parallax';
			}
		}

		if ( $title_full_height === 'yes' ) {
			$classes[] = 'mkdf-title-full-height';
		}

		if ( $title_pattern === 'yes' ) {
			$classes[] = 'mkdf-title-pattern';
		}

		return implode( ' ', apply_filters( 'holmes_mkdf_title_holder_classes', $classes ) );
	}
}

if ( ! function_exists( 'holmes_mkdf_get_title_holder_styles' ) ) {
	/**
	 * Function that adds inline styles to title holder div
	 */
	function holmes_mkdf_get_title_holder_styles() {
		$page_id              = holmes_mkdf_get_page_id();
		$title_height         = holmes_mkdf_get_title_area_height();
		$title_bg_color       = holmes_mkdf_get_meta_field_intersect( 'title_area_background_color', $page_id );
		$title_image          = holmes_mkdf_get_meta_field_intersect( 'title_area_background_image', $page_id );
		$title_image_behavior = holmes_mkdf_get_meta_field_intersect( 'title_area_background_image_behavior', $page_id );
		$title_full_height    = holmes_mkdf_get_meta_field_intersect( 'title_area_full_height', $page_id );

		$styles = array();

		// TODO: calc title area height if full height option is being used
		if ( ! empty( $title_height ) && $title_full_height === 'no' ) {
			$styles[] = 'height: ' . $title_height . 'px';
		}

		if ( ! empty( $title_bg_color ) ) {
			$styles[] = 'background-color: ' . $title_bg_color;
		}

		if ( ! empty( $title_image ) && $title_image_behavior !== 'hide' ) {
			$styles[] = 'background-image:url(' . esc_url( $title_image ) . ');';
		}

		return implode( ';', $styles );
	}
}

if ( ! function_exists( 'holmes_mkdf_get_title_holder_data' ) ) {
	/**
	 * Function that adds data attributes to title holder div
	 */
	function holmes_mkdf_get_title_holder_data() {
		$page_id            = holmes_mkdf_get_page_id();
		$title_height       = holmes_mkdf_get_title_area_height();
		$title_img          = holmes_mkdf_get_meta_field_intersect( 'title_area_background_image', $page_id );
		$title_img_behavior = holmes_mkdf_get_meta_field_intersect( 'title_area_background_image_behavior', $page_id );
		$title_full_height  = holmes_mkdf_get_meta_field_intersect( 'title_area_full_height', $page_id );

		$data = array();

		if ( ! empty( $title_height ) && $title_full_height === 'no' ) {
			$data['data-height'] = $title_height;
		}

		if ( ! empty( $title_img ) && $title_img_behavior === 'parallax-zoom-out' ) {
			$attachment_dimensions = holmes_mkdf_get_image_dimensions( $title_img );

			if ( ! empty( $attachment_dimensions['width'] ) ) {
				$data['data-background-width'] = esc_attr( $attachment_dimensions['width'] );
			}
		}

		return apply_filters( 'holmes_mkdf_title_holder_data', $data );
	}
}

if ( ! function_exists( 'holmes_mkdf_get_title_wrapper_styles' ) ) {
	/**
	 * Function that adds inline styles to title wrapper div
	 */
	function holmes_mkdf_get_title_wrapper_styles() {
		$page_id                  = holmes_mkdf_get_page_id();
		$title_height             = holmes_mkdf_get_title_area_height();
		$title_content_padding    = holmes_mkdf_get_title_content_padding();
		$title_img_behavior       = holmes_mkdf_get_meta_field_intersect( 'title_area_background_image_behavior', $page_id );
		$title_vertical_alignment = holmes_mkdf_get_meta_field_intersect( 'title_area_vertical_alignment', $page_id );
		$title_full_height        = holmes_mkdf_get_meta_field_intersect( 'title_area_full_height', $page_id );

		$styles = array();

		if ( $title_vertical_alignment === 'top-header-bottom' || $title_vertical_alignment === 'center-header-bottom' ) {
			if ( $title_img_behavior !== 'responsive' && $title_full_height === 'no' ) {
				if ( ! empty( $title_content_padding ) ) {
					$styles[] = 'height: ' . ( $title_height - $title_content_padding ) . 'px';
				} else {
					$styles[] = 'height: ' . $title_height . 'px';
				}
			}

			if ( ! empty( $title_content_padding ) ) {
				$styles[] = 'padding-top: ' . $title_content_padding . 'px';
			}
		}

		return implode( ';', $styles );
	}
}

if ( ! function_exists( 'holmes_mkdf_get_title_background_image' ) ) {
	/**
	 * Function that return background image data if background image is set
	 */
	function holmes_mkdf_get_title_background_image() {
		$page_id            = holmes_mkdf_get_page_id();
		$title_img          = holmes_mkdf_get_meta_field_intersect( 'title_area_background_image', $page_id );
		$title_img_behavior = holmes_mkdf_get_meta_field_intersect( 'title_area_background_image_behavior', $page_id );

		$image = array();

		if ( ! empty( $title_img ) && $title_img_behavior !== 'hide' ) {
			$image_id = holmes_mkdf_get_attachment_id_from_url( $title_img );
			$alt      = ! empty( $image_id ) ? get_post_meta( $image_id, '_wp_attachment_image_alt', true ) : '';

			$image['src'] = $title_img;
			$image['alt'] = ! empty( $alt ) ? esc_html( $alt ) : esc_html__( 'Image Alt', 'holmes' );
		}

		return $image;
	}
}

if ( ! function_exists( 'holmes_mkdf_get_title_area_height' ) ) {
	/**
	 * Function that returns title area height
	 **/
	function holmes_mkdf_get_title_area_height() {
		$page_id           = holmes_mkdf_get_page_id();
		$title_height_meta = holmes_mkdf_get_meta_field_intersect( 'title_area_height', $page_id );
		$title_height      = ! empty( $title_height_meta ) ? intval( $title_height_meta ) : apply_filters( 'holmes_mkdf_title_area_default_height_value', 210 );

		return apply_filters( 'holmes_mkdf_title_area_height', $title_height );
	}
}

if ( ! function_exists( 'holmes_mkdf_get_title_content_padding' ) ) {
	/**
	 * Function that returns title content padding
	 **/
	function holmes_mkdf_get_title_content_padding() {
		$title_content_padding = apply_filters( 'holmes_mkdf_title_content_padding', 0 );

		return intval( $title_content_padding );
	}
}

if ( ! function_exists( 'holmes_mkdf_get_title_text' ) ) {
	/**
	 * Function that returns current page title text
	 */
	function holmes_mkdf_get_title_text() {
		$page_id = holmes_mkdf_get_page_id();
		$title   = get_the_title( $page_id );

		if ( ( is_home() && is_front_page() ) ) {
			$title = get_option( 'blogname' );
		} elseif ( is_tag() ) {
			$title = single_term_title( '', false ) . esc_html__( ' Tag', 'holmes' );
		} elseif ( is_date() ) {
			$title = get_the_time( 'F Y' );
		} elseif ( is_author() ) {
			$title = esc_html__( 'Author:', 'holmes' ) . " " . get_the_author();
		} elseif ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_archive() ) {
			$title = esc_html__( 'Archive', 'holmes' );
		} elseif ( is_search() ) {
			$title = esc_html__( 'Search results for: ', 'holmes' ) . get_search_query();
		} elseif ( is_404() ) {
			$title_404 = holmes_mkdf_options()->getOptionValue( '404_title' );
			$title     = ! empty( $title_404 ) ? $title_404 : esc_html__( '404 - Page not found', 'holmes' );
		}

		return apply_filters( 'holmes_mkdf_title_text', $title );
	}
}

if ( ! function_exists( 'holmes_mkdf_get_title_styles' ) ) {
	/**
	 * Function that adds inline styles to page title
	 */
	function holmes_mkdf_get_title_styles() {
		$page_id = holmes_mkdf_get_page_id();
		$color   = get_post_meta( $page_id, 'mkdf_title_text_color_meta', true );

		$styles = array();

		if ( ! empty( $color ) ) {
			$styles[] = 'color: ' . esc_attr( $color );
		}

		return implode( ';', $styles );
	}
}

if ( ! function_exists( 'holmes_mkdf_subtitle_text' ) ) {
	/**
	 * Function that echoes subtitle text.
	 */
	function holmes_mkdf_subtitle_text() {
		$page_id       = holmes_mkdf_get_page_id();
		$subtitle_meta = get_post_meta( $page_id, 'mkdf_title_area_subtitle_meta', true );
		$subtitle      = ! empty( $subtitle_meta ) ? $subtitle_meta : '';

		return apply_filters( 'holmes_mkdf_subtitle_title_text', $subtitle );
	}
}

if ( ! function_exists( 'holmes_mkdf_get_subtitle_styles' ) ) {
	/**
	 * Function that adds inline styles to page subtitle
	 */
	function holmes_mkdf_get_subtitle_styles() {
		$page_id      = holmes_mkdf_get_page_id();
		$color        = get_post_meta( $page_id, 'mkdf_subtitle_color_meta', true );
		$side_padding = get_post_meta( $page_id, 'mkdf_subtitle_side_padding_meta', true );

		$styles = array();

		if ( ! empty( $color ) ) {
			$styles[] = 'color: ' . $color;
		}

		if ( $side_padding !== '' ) {
			if ( holmes_mkdf_string_ends_with( $side_padding, '%' ) || holmes_mkdf_string_ends_with( $side_padding, 'px' ) ) {
				$styles[] = 'padding: 0 ' . $side_padding;
			} else {
				$styles[] = 'padding: 0 ' . intval( $side_padding ) . 'px';
			}
		}

		return implode( ';', $styles );
	}
}
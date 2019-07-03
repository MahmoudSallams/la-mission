<?php

namespace Holmes\Modules\Header\Types;

use Holmes\Modules\Header\Lib\HeaderType;

/**
 * Class that represents Header expanding layout and option
 *
 * Class Headerexpanding
 */
class HeaderExpanding extends HeaderType {
	protected $heightOfTransparency;
	protected $heightOfCompleteTransparency;
	protected $headerHeight;
	protected $mobileHeaderHeight;

	/**
	 * Sets slug property which is the same as value of option in DB
	 */
	public function __construct() {
		$this->slug = 'header-expanding';

		if ( ! is_admin() ) {
			$this->menuAreaHeight     = holmes_mkdf_set_default_menu_height_for_header_types();
			$this->mobileHeaderHeight = holmes_mkdf_set_default_mobile_menu_height_for_header_types();

			add_action( 'wp', array( $this, 'setHeaderHeightProps' ) );

			add_filter( 'holmes_mkdf_js_global_variables', array( $this, 'getGlobalJSVariables' ) );
			add_filter( 'holmes_mkdf_per_page_js_vars', array( $this, 'getPerPageJSVariables' ) );

			add_filter( 'body_class', array( $this, 'bodyPerPageClasses' ) );
		}
	}

	/**
	 * Loads template file for this header type
	 *
	 * @param array $parameters associative array of variables that needs to passed to template
	 */
	public function loadTemplate( $parameters = array() ) {

		$parameters['fullscreen_menu_icon_class'] = holmes_mkdf_get_expanded_menu_icon_class();
		holmes_mkdf_get_module_template_part( 'templates/' . $this->slug, $this->moduleName . '/types/' . $this->slug, '', $parameters );

	}

	/**
	 * Sets header height properties after WP object is set up
	 */
	public function setHeaderHeightProps() {
		$this->heightOfTransparency         = $this->calculateHeightOfTransparency();
		$this->heightOfCompleteTransparency = $this->calculateHeightOfCompleteTransparency();
		$this->headerHeight                 = $this->calculateHeaderHeight();
		$this->mobileHeaderHeight           = $this->calculateMobileHeaderHeight();
	}

	/**
	 * Returns total height of transparent parts of header
	 *
	 * @return int
	 */
	public function calculateHeightOfTransparency() {
		$id                 = holmes_mkdf_get_page_id();
		$transparencyHeight = 0;

		$menu_background_color_meta        = get_post_meta( $id, 'mkdf_menu_area_background_color_meta', true );
		$menu_background_transparency_meta = get_post_meta( $id, 'mkdf_menu_area_background_transparency_meta', true );
		$menu_background_color             = holmes_mkdf_options()->getOptionValue( 'menu_area_background_color' );
		$menu_background_transparency      = holmes_mkdf_options()->getOptionValue( 'menu_area_background_transparency' );
		$menu_grid_background_color        = holmes_mkdf_options()->getOptionValue( 'menu_area_grid_background_color' );
		$menu_grid_background_transparency = holmes_mkdf_options()->getOptionValue( 'menu_area_grid_background_transparency' );

		if ( ! empty( $menu_background_color_meta ) ) {
			$menuAreaTransparent = ! empty( $menu_background_color_meta ) && $menu_background_transparency_meta !== '1';
		} elseif ( empty( $menu_background_color ) ) {
			$menuAreaTransparent = ! empty( $menu_grid_background_color ) && $menu_grid_background_transparency !== '1';
		} else {
			$menuAreaTransparent = ! empty( $menu_background_color ) && $menu_background_transparency !== '1';
		}

		$sliderExists        = get_post_meta( $id, 'mkdf_page_slider_meta', true ) !== '';
		$contentBehindHeader = get_post_meta( $id, 'mkdf_page_content_behind_header_meta', true ) === 'yes';

		if ( $sliderExists || $contentBehindHeader || is_404() || is_archive() ) {
			$menuAreaTransparent = true;
		}

		if ( $menuAreaTransparent ) {
			if ( $menuAreaTransparent ) {
				$transparencyHeight = $this->menuAreaHeight + 25; // 25 is initial distance of header
			}
		}

		return $transparencyHeight;
	}

	/**
	 * Returns height of completely transparent header parts
	 *
	 * @return int
	 */
	public function calculateHeightOfCompleteTransparency() {
		$id                 = holmes_mkdf_get_page_id();
		$transparencyHeight = 0;

		$menu_background_color_meta        = get_post_meta( $id, 'mkdf_menu_area_background_color_meta', true );
		$menu_background_transparency_meta = get_post_meta( $id, 'mkdf_menu_area_background_transparency_meta', true );
		$menu_background_color             = holmes_mkdf_options()->getOptionValue( 'menu_area_background_color' );
		$menu_background_transparency      = holmes_mkdf_options()->getOptionValue( 'menu_area_background_transparency' );
		$menu_grid_background_color        = holmes_mkdf_options()->getOptionValue( 'menu_area_grid_background_color' );
		$menu_grid_background_transparency = holmes_mkdf_options()->getOptionValue( 'menu_area_grid_background_transparency' );

		if ( ! empty( $menu_background_color_meta ) ) {
			$menuAreaTransparent = ! empty( $menu_background_color_meta ) && $menu_background_transparency_meta === '0';
		} elseif ( empty( $menu_background_color ) ) {
			$menuAreaTransparent = ! empty( $menu_grid_background_color ) && $menu_grid_background_transparency === '0';
		} else {
			$menuAreaTransparent = ! empty( $menu_background_color ) && $menu_background_transparency === '0';
		}

		if ( $menuAreaTransparent ) {

			if ( $menuAreaTransparent ) {
				$transparencyHeight = $this->menuAreaHeight;
			}
		}

		return $transparencyHeight;
	}


	/**
	 * Returns total height of header
	 *
	 * @return int|string
	 */
	public function calculateHeaderHeight() {
		$headerHeight = $this->menuAreaHeight;
		if ( holmes_mkdf_is_top_bar_enabled() ) {
			$headerHeight += holmes_mkdf_get_top_bar_height();
		}

		return $headerHeight;
	}

	/**
	 * Returns total height of mobile header
	 *
	 * @return int|string
	 */
	public function calculateMobileHeaderHeight() {
		$mobileHeaderHeight = $this->mobileHeaderHeight;

		return $mobileHeaderHeight;
	}

	/**
	 * Returns global js variables of header
	 *
	 * @param $globalVariables
	 *
	 * @return int|string
	 */
	public function getGlobalJSVariables( $globalVariables ) {
		$globalVariables['mkdfLogoAreaHeight']     = 0;
		$globalVariables['mkdfMenuAreaHeight']     = $this->menuAreaHeight;
		$globalVariables['mkdfMobileHeaderHeight'] = $this->mobileHeaderHeight;

		return $globalVariables;
	}

	/**
	 * Returns per page js variables of header
	 *
	 * @param $perPageVars
	 *
	 * @return int|string
	 */
	public function getPerPageJSVariables( $perPageVars ) {
		//calculate transparency height only if header has no sticky behaviour
		$header_behavior = holmes_mkdf_get_meta_field_intersect( 'header_behaviour' );
		if ( ! in_array( $header_behavior, array(
			'sticky-header-on-scroll-up',
			'sticky-header-on-scroll-down-up'
		) ) ) {
			$perPageVars['mkdfHeaderTransparencyHeight'] = $this->headerHeight - ( holmes_mkdf_get_top_bar_height() + $this->heightOfCompleteTransparency );
		} else {
			$perPageVars['mkdfHeaderTransparencyHeight'] = 0;
		}

		return $perPageVars;
	}

	public function bodyPerPageClasses( $classes ) {
		if ( $this->heightOfCompleteTransparency > 0 ) {
			$classes[] = 'mkdf-header-transparent';
		}

		return $classes;
	}

}
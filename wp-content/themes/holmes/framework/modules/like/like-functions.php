<?php

if ( ! function_exists( 'holmes_mkdf_like' ) ) {
	/**
	 * Returns HolmesMkdfLike instance
	 *
	 * @return HolmesMkdfLike
	 */
	function holmes_mkdf_like() {
		return HolmesMkdfLike::get_instance();
	}
}

function holmes_mkdf_get_like() {
	
	echo wp_kses( holmes_mkdf_like()->add_like(), array(
		'span' => array(
			'class'       => true,
			'aria-hidden' => true,
			'style'       => true,
			'id'          => true
		),
		'i'    => array(
			'class' => true,
			'style' => true,
			'id'    => true
		),
		'a'    => array(
			'href'  => true,
			'class' => true,
			'id'    => true,
			'title' => true,
			'style' => true
		)
	) );
}
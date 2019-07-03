<?php

if ( ! function_exists( 'holmes_mkdf_portfolio_category_additional_fields' ) ) {
	function holmes_mkdf_portfolio_category_additional_fields() {
		
		$fields = holmes_mkdf_add_taxonomy_fields(
			array(
				'scope' => 'portfolio-category',
				'name'  => 'portfolio_category_options'
			)
		);
		
		holmes_mkdf_add_taxonomy_field(
			array(
				'name'   => 'mkdf_portfolio_category_image_meta',
				'type'   => 'image',
				'label'  => esc_html__( 'Category Image', 'holmes-core' ),
				'parent' => $fields
			)
		);
	}
	
	add_action( 'holmes_mkdf_custom_taxonomy_fields', 'holmes_mkdf_portfolio_category_additional_fields' );
}
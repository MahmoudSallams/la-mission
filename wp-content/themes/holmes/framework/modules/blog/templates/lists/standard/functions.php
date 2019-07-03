<?php

if ( ! function_exists( 'holmes_mkdf_register_blog_standard_template_file' ) ) {
	/**
	 * Function that register blog standard template
	 */
	function holmes_mkdf_register_blog_standard_template_file( $templates ) {
		$templates['blog-standard'] = esc_html__( 'Blog: Standard', 'holmes' );
		
		return $templates;
	}
	
	add_filter( 'holmes_mkdf_register_blog_templates', 'holmes_mkdf_register_blog_standard_template_file' );
}

if ( ! function_exists( 'holmes_mkdf_set_blog_standard_type_global_option' ) ) {
	/**
	 * Function that set blog list type value for global blog option map
	 */
	function holmes_mkdf_set_blog_standard_type_global_option( $options ) {
		$options['standard'] = esc_html__( 'Blog: Standard', 'holmes' );
		
		return $options;
	}
	
	add_filter( 'holmes_mkdf_blog_list_type_global_option', 'holmes_mkdf_set_blog_standard_type_global_option' );
}
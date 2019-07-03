<?php

namespace HolmesCore\CPT\Testimonials;

use HolmesCore\Lib;

/**
 * Class TestimonialsRegister
 * @package HolmesCore\CPT\Testimonials
 */
class TestimonialsRegister implements Lib\PostTypeInterface {
	private $base;
	
	public function __construct() {
		$this->base    = 'testimonials';
		$this->taxBase = 'testimonials-category';
	}
	
	/**
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}
	
	/**
	 * Registers custom post type with WordPress
	 */
	public function register() {
		$this->registerPostType();
		$this->registerTax();
	}
	
	/**
	 * Regsiters custom post type with WordPress
	 */
	private function registerPostType() {
		$menuPosition = 5;
		$menuIcon     = 'dashicons-format-quote';
		
		register_post_type( 'testimonials',
			array(
				'labels'        => array(
					'menu_name'     => esc_html__( 'Holmes Testimonials', 'holmes-core' ),
					'name'          => esc_html__( 'Testimonials', 'holmes-core' ),
					'singular_name' => esc_html__( 'Testimonial', 'holmes-core' ),
					'add_item'      => esc_html__( 'New Testimonial', 'holmes-core' ),
					'add_new_item'  => esc_html__( 'Add New Testimonial', 'holmes-core' ),
					'edit_item'     => esc_html__( 'Edit Testimonial', 'holmes-core' )
				),
				'public'        => false,
				'show_in_menu'  => true,
				'rewrite'       => array( 'slug' => 'testimonials' ),
				'menu_position' => $menuPosition,
				'show_ui'       => true,
				'has_archive'   => false,
				'hierarchical'  => false,
				'supports'      => array( 'title', 'thumbnail' ),
				'menu_icon'     => $menuIcon
			)
		);
	}
	
	/**
	 * Registers custom taxonomy with WordPress
	 */
	private function registerTax() {
		$labels = array(
			'name'              => esc_html__( 'Testimonials Categories', 'holmes-core' ),
			'singular_name'     => esc_html__( 'Testimonial Category', 'holmes-core' ),
			'search_items'      => esc_html__( 'Search Testimonials Categories', 'holmes-core' ),
			'all_items'         => esc_html__( 'All Testimonials Categories', 'holmes-core' ),
			'parent_item'       => esc_html__( 'Parent Testimonial Category', 'holmes-core' ),
			'parent_item_colon' => esc_html__( 'Parent Testimonial Category:', 'holmes-core' ),
			'edit_item'         => esc_html__( 'Edit Testimonials Category', 'holmes-core' ),
			'update_item'       => esc_html__( 'Update Testimonials Category', 'holmes-core' ),
			'add_new_item'      => esc_html__( 'Add New Testimonials Category', 'holmes-core' ),
			'new_item_name'     => esc_html__( 'New Testimonials Category Name', 'holmes-core' ),
			'menu_name'         => esc_html__( 'Testimonials Categories', 'holmes-core' )
		);
		
		register_taxonomy( $this->taxBase, array( $this->base ), array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'query_var'         => true,
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'testimonials-category' )
		) );
	}
}
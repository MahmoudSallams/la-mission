<?php

namespace HolmesCore\CPT\MasonryGallery;

use HolmesCore\Lib;

/**
 * Class MasonryGalleryRegister
 * @package HolmesCore\CPT\MasonryGallery
 */
class MasonryGalleryRegister implements Lib\PostTypeInterface {
	private $base;
	
	public function __construct() {
		$this->base    = 'masonry-gallery';
		$this->taxBase = 'masonry-gallery-category';
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
	 * Registers custom post type with WordPress
	 */
	private function registerPostType() {
		$menuPosition = 5;
		$menuIcon     = 'dashicons-schedule';
		
		register_post_type( $this->base,
			array(
				'labels'        => array(
					'name'          => esc_html__( 'Holmes Masonry Gallery', 'holmes-core' ),
					'all_items'     => esc_html__( 'Masonry Gallery Items', 'holmes-core' ),
					'singular_name' => esc_html__( 'Masonry Gallery Item', 'holmes-core' ),
					'add_item'      => esc_html__( 'New Masonry Gallery Item', 'holmes-core' ),
					'add_new_item'  => esc_html__( 'Add New Masonry Gallery Item', 'holmes-core' ),
					'edit_item'     => esc_html__( 'Edit Masonry Gallery Item', 'holmes-core' )
				),
				'public'        => false,
				'show_in_menu'  => true,
				'rewrite'       => array( 'slug' => 'masonry-gallery' ),
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
			'name'              => esc_html__( 'Masonry Gallery Categories', 'holmes-core' ),
			'singular_name'     => esc_html__( 'Masonry Gallery Category', 'holmes-core' ),
			'search_items'      => esc_html__( 'Search Masonry Gallery Categories', 'holmes-core' ),
			'all_items'         => esc_html__( 'All Masonry Gallery Categories', 'holmes-core' ),
			'parent_item'       => esc_html__( 'Parent Masonry Gallery Category', 'holmes-core' ),
			'parent_item_colon' => esc_html__( 'Parent Masonry Gallery Category:', 'holmes-core' ),
			'edit_item'         => esc_html__( 'Edit Masonry Gallery Category', 'holmes-core' ),
			'update_item'       => esc_html__( 'Update Masonry Gallery Category', 'holmes-core' ),
			'add_new_item'      => esc_html__( 'Add New Masonry Gallery Category', 'holmes-core' ),
			'new_item_name'     => esc_html__( 'New Masonry Gallery Category Name', 'holmes-core' ),
			'menu_name'         => esc_html__( 'Masonry Gallery Categories', 'holmes-core' )
		);
		
		register_taxonomy( $this->taxBase, array( $this->base ), array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'query_var'         => true,
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'masonry-gallery-category' )
		) );
	}
}
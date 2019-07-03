<?php

if ( ! function_exists( 'holmes_mkdf_logo_options_map' ) ) {
	function holmes_mkdf_logo_options_map() {
		
		holmes_mkdf_add_admin_page(
			array(
				'slug'  => '_logo_page',
				'title' => esc_html__( 'Logo', 'holmes' ),
				'icon'  => 'fa fa-coffee'
			)
		);
		
		$panel_logo = holmes_mkdf_add_admin_panel(
			array(
				'page'  => '_logo_page',
				'name'  => 'panel_logo',
				'title' => esc_html__( 'Logo', 'holmes' )
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'parent'        => $panel_logo,
				'type'          => 'yesno',
				'name'          => 'hide_logo',
				'default_value' => 'no',
				'label'         => esc_html__( 'Hide Logo', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will hide logo image', 'holmes' )
			)
		);
		
		$hide_logo_container = holmes_mkdf_add_admin_container(
			array(
				'parent'          => $panel_logo,
				'name'            => 'hide_logo_container',
				'dependency' => array(
					'hide' => array(
						'hide_logo'  => 'yes'
					)
				)
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'logo_image',
				'type'          => 'image',
				'default_value' => MIKADO_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Default', 'holmes' ),
				'parent'        => $hide_logo_container
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'logo_image_dark',
				'type'          => 'image',
				'default_value' => MIKADO_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Dark', 'holmes' ),
				'parent'        => $hide_logo_container
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'logo_image_light',
				'type'          => 'image',
				'default_value' => MIKADO_ASSETS_ROOT . "/img/logo_white.png",
				'label'         => esc_html__( 'Logo Image - Light', 'holmes' ),
				'parent'        => $hide_logo_container
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'logo_image_sticky',
				'type'          => 'image',
				'default_value' => MIKADO_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Sticky', 'holmes' ),
				'parent'        => $hide_logo_container
			)
		);
		
		holmes_mkdf_add_admin_field(
			array(
				'name'          => 'logo_image_mobile',
				'type'          => 'image',
				'default_value' => MIKADO_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Mobile', 'holmes' ),
				'parent'        => $hide_logo_container
			)
		);
	}
	
	add_action( 'holmes_mkdf_options_map', 'holmes_mkdf_logo_options_map', holmes_mkdf_set_options_map_position( 'logo' ) );
}
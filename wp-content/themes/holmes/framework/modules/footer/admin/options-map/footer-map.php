<?php

if ( ! function_exists( 'holmes_mkdf_footer_options_map' ) ) {
	function holmes_mkdf_footer_options_map() {

		holmes_mkdf_add_admin_page(
			array(
				'slug'  => '_footer_page',
				'title' => esc_html__( 'Footer', 'holmes' ),
				'icon'  => 'fa fa-sort-amount-asc'
			)
		);

		$footer_panel = holmes_mkdf_add_admin_panel(
			array(
				'title' => esc_html__( 'Footer', 'holmes' ),
				'name'  => 'footer',
				'page'  => '_footer_page'
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'footer_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Footer in Grid', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will place Footer content in grid', 'holmes' ),
				'parent'        => $footer_panel
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'uncovering_footer',
				'default_value' => 'no',
				'label'         => esc_html__( 'Uncovering Footer', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'holmes' ),
				'parent'        => $footer_panel,
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_top',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Top', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'holmes' ),
				'parent'        => $footer_panel,
			)
		);

		$show_footer_top_container = holmes_mkdf_add_admin_container(
			array(
				'name'       => 'show_footer_top_container',
				'parent'     => $footer_panel,
				'dependency' => array(
					'show' => array(
						'show_footer_top' => 'yes'
					)
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns',
				'parent'        => $show_footer_top_container,
				'default_value' => '3 9',
				'label'         => esc_html__( 'Footer Top Columns', 'holmes' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Top area', 'holmes' ),
				'options'       => array(
					'12'      => '1',
					'6 6'     => '2',
					'3 9'     => '2 (25% + 75%)',
					'4 4 4'   => '3',
					'3 3 6'   => '3 (25% + 25% + 50%)',
					'3 3 3 3' => '4'
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns_alignment',
				'default_value' => 'left',
				'label'         => esc_html__( 'Footer Top Columns Alignment', 'holmes' ),
				'description'   => esc_html__( 'Text Alignment in Footer Columns', 'holmes' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'holmes' ),
					'left'   => esc_html__( 'Left', 'holmes' ),
					'center' => esc_html__( 'Center', 'holmes' ),
					'right'  => esc_html__( 'Right', 'holmes' )
				),
				'parent'        => $show_footer_top_container,
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'        => 'footer_top_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'holmes' ),
				'description' => esc_html__( 'Set background color for top footer area', 'holmes' ),
				'parent'      => $show_footer_top_container
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_middle',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show Footer middle', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will show Footer middle area', 'holmes' ),
				'parent'        => $footer_panel,
			)
		);

		$show_footer_middle_container = holmes_mkdf_add_admin_container(
			array(
				'name'       => 'show_footer_middle_container',
				'parent'     => $footer_panel,
				'dependency' => array(
					'show' => array(
						'show_footer_middle' => 'yes'
					)
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_middle_columns',
				'parent'        => $show_footer_middle_container,
				'default_value' => '3 3 3 3',
				'label'         => esc_html__( 'Footer middle Columns', 'holmes' ),
				'description'   => esc_html__( 'Choose number of columns for Footer middle area', 'holmes' ),
				'options'       => array(
					'12'      => '1',
					'6 6'     => '2',
					'4 4 4'   => '3',
					'3 3 6'   => '3 (25% + 25% + 50%)',
					'3 3 3 3' => '4'
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_middle_columns_alignment',
				'default_value' => 'left',
				'label'         => esc_html__( 'Footer middle Columns Alignment', 'holmes' ),
				'description'   => esc_html__( 'Text Alignment in Footer Columns', 'holmes' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'holmes' ),
					'left'   => esc_html__( 'Left', 'holmes' ),
					'center' => esc_html__( 'Center', 'holmes' ),
					'right'  => esc_html__( 'Right', 'holmes' )
				),
				'parent'        => $show_footer_middle_container,
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'        => 'footer_middle_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'holmes' ),
				'description' => esc_html__( 'Set background color for middle footer area', 'holmes' ),
				'parent'      => $show_footer_middle_container
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_bottom',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show Footer Bottom', 'holmes' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'holmes' ),
				'parent'        => $footer_panel,
			)
		);

		$show_footer_bottom_container = holmes_mkdf_add_admin_container(
			array(
				'name'       => 'show_footer_bottom_container',
				'parent'     => $footer_panel,
				'dependency' => array(
					'show' => array(
						'show_footer_bottom' => 'yes'
					)
				)
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_bottom_columns',
				'default_value' => '6 6',
				'label'         => esc_html__( 'Footer Bottom Columns', 'holmes' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Bottom area', 'holmes' ),
				'options'       => array(
					'12'    => '1',
					'6 6'   => '2',
					'4 4 4' => '3'
				),
				'parent'        => $show_footer_bottom_container,
			)
		);

		holmes_mkdf_add_admin_field(
			array(
				'name'        => 'footer_bottom_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'holmes' ),
				'description' => esc_html__( 'Set background color for bottom footer area', 'holmes' ),
				'parent'      => $show_footer_bottom_container
			)
		);
	}

	add_action( 'holmes_mkdf_options_map', 'holmes_mkdf_footer_options_map', holmes_mkdf_set_options_map_position( 'footer' ) );
}
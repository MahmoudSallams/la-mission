<?php

class HolmesMkdfFollowUsWidget extends HolmesMkdfWidget {
	public function __construct() {
		parent::__construct(
			'mkdf_follow_us_widget',
			esc_html__( 'Holmes Follow Us Widget', 'holmes' )
		);

		$this->setParams();
	}

	protected function setParams() {

		$this->params = array(
			array(
				'type'  => 'textfield',
				'name'  => 'widget_bottom_margin',
				'title' => esc_html__( 'Widget Bottom Margin (px)', 'holmes' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'widget_title',
				'title' => esc_html__( 'Widget Title', 'holmes' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'widget_title_bottom_margin',
				'title' => esc_html__( 'Widget Title Bottom Margin (px)', 'holmes' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'subtitle',
				'title' => esc_html__( 'Subtitle', 'holmes' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'image',
				'title'       => esc_html__( 'Image ID', 'holmes' ),
				'description' => esc_html__( 'Add image id', 'holmes' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'target',
				'title'   => esc_html__( 'Links Target', 'holmes' ),
				'options' => array(
					'_blank' => esc_html__( 'New Window', 'holmes' ),
					''       => esc_html__( 'Same Window', 'holmes' ),
				),
			),
			array(
				'type'  => 'textfield',
				'name'  => 'link_one',
				'title' => esc_html__( 'Link One', 'holmes' ),
			),
			array(
				'type'  => 'textfield',
				'name'  => 'label_one',
				'title' => esc_html__( 'Label One', 'holmes' ),
			),
			array(
				'type'  => 'textfield',
				'name'  => 'link_two',
				'title' => esc_html__( 'Link Two', 'holmes' ),
			),
			array(
				'type'  => 'textfield',
				'name'  => 'label_two',
				'title' => esc_html__( 'Label Two', 'holmes' ),
			),
			array(
				'type'  => 'textfield',
				'name'  => 'link_three',
				'title' => esc_html__( 'Link Three', 'holmes' ),
			),
			array(
				'type'  => 'textfield',
				'name'  => 'label_three',
				'title' => esc_html__( 'Label Three', 'holmes' ),
			),
			array(
				'type'  => 'textfield',
				'name'  => 'link_four',
				'title' => esc_html__( 'Link Four', 'holmes' ),
			),
			array(
				'type'  => 'textfield',
				'name'  => 'label_four',
				'title' => esc_html__( 'Label Four', 'holmes' ),
			),
		);
	}

	public function widget( $args, $instance ) {
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}

		$widget_styles = array();
		if ( isset( $instance['widget_bottom_margin'] ) && $instance['widget_bottom_margin'] !== '' ) {
			$widget_styles[] = 'margin-bottom: ' . holmes_mkdf_filter_px( $instance['widget_bottom_margin'] ) . 'px';
		}

		$widget_title_styles = array();
		if ( isset( $instance['widget_title_bottom_margin'] ) && $instance['widget_title_bottom_margin'] !== '' ) {
			$widget_title_styles[] = 'margin-bottom: ' . holmes_mkdf_filter_px( $instance['widget_title_bottom_margin'] ) . 'px';
		}

		$html = '<div class="widget mkdf-follow-us-widget" ' . holmes_mkdf_get_inline_style( $widget_styles ) . '>';

		if ( ! empty( $instance['widget_title'] ) ) {
			if ( ! empty( $widget_title_styles ) ) {
				$args['before_title'] = holmes_mkdf_widget_modified_before_title( $args['before_title'], $widget_title_styles );
			}

			$html .= wp_kses_post( $args['before_title'] ) . esc_html( $instance['widget_title'] ) . wp_kses_post( $args['after_title'] );
		}

		$html .= '<div class="mkdf-fu__inner">';
		if ( isset( $instance['image'] ) && $instance['image'] !== '' ):
			$html .= '<div class="mkdf-fu__image">';
			$html .= wp_get_attachment_image( $instance['image'], [ 60, 60 ] );
			$html .= '</div>';
		endif;
		$html .= '<div class="mkdf-fu__icons">';
		if ( isset( $instance['subtitle'] ) && $instance['subtitle'] !== '' ):
			$html .= '<span class="mkdf-fu__subtitle">' . esc_html( $instance['subtitle'] ) . '</span>';
		endif;

		/////

		$html .= '<h5 class="mkdf-fu__links">';

		if ( ! empty( $instance['link_one'] ) ):
			$html .= '<a class="mkdf-fu__link" href="' . esc_attr( $instance['link_one'] ) . ' " target="' . esc_attr( $instance['target'] ) . ' ">';
			$html .= esc_attr( $instance['label_one'] );
			$html .= '</a>';
		endif;

		if ( ! empty( $instance['link_two'] ) ):
			$html .= '<a class="mkdf-fu__link" href="' . esc_attr( $instance['link_two'] ) . ' " target="' . esc_attr( $instance['target'] ) . ' ">';
			$html .= esc_attr( $instance['label_two'] );
			$html .= '</a>';
		endif;

		if ( ! empty( $instance['link_three'] ) ):
			$html .= '<a class="mkdf-fu__link" href="' . esc_attr( $instance['link_three'] ) . ' " target="' . esc_attr( $instance['target'] ) . ' ">';
			$html .= esc_attr( $instance['label_three'] );
			$html .= '</a>';
		endif;

		if ( ! empty( $instance['link_four'] ) ):
			$html .= '<a class="mkdf-fu__link" href="' . esc_attr( $instance['link_four'] ) . ' " target="' . esc_attr( $instance['target'] ) . ' ">';
			$html .= esc_attr( $instance['label_four'] );
			$html .= '</a>';
		endif;

		$html .= '</h5>';

		/////

		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';

		print holmes_mkdf_get_clean_output( $html );
	}
}
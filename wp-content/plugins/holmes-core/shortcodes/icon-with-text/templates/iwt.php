<div <?php holmes_mkdf_class_attribute( $holder_classes ); ?>>
    <div class="mkdf-iwt-icon" style="padding: <?php echo esc_html( $icon_padding ) ?>">
		<?php if ( ! empty( $link ) && $show_button == 'no' ) : ?>
        <a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
			<?php endif; ?>
			<?php if ( ! empty( $custom_icon ) ) : ?>
				<?php echo wp_get_attachment_image( $custom_icon, 'full' ); ?>
			<?php else: ?>
				<?php echo holmes_core_get_shortcode_module_template_part( 'templates/icon', 'icon-with-text', '', array( 'icon_parameters' => $icon_parameters ) ); ?>
			<?php endif; ?>
			<?php if ( ! empty( $link ) ) : ?>
        </a>
	<?php endif; ?>
    </div>
    <div class="mkdf-iwt-content" <?php holmes_mkdf_inline_style( $content_styles ); ?>>
		<?php if ( ! empty( $title ) ) { ?>
        <<?php echo esc_attr( $title_tag ); ?> class="mkdf-iwt-title" <?php holmes_mkdf_inline_style( $title_styles ); ?>>
		<?php if ( ! empty( $link ) ) : ?>
        <a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
			<?php endif; ?>
            <span class="mkdf-iwt-title-text"><?php echo esc_html( $title ); ?></span>
			<?php if ( ! empty( $link ) ) : ?>
        </a>
	<?php endif; ?>
    </<?php echo esc_attr( $title_tag ); ?>>
	<?php } ?>
	<?php if ( ! empty( $text ) ) { ?>
        <p class="mkdf-iwt-text" <?php holmes_mkdf_inline_style( $text_styles ); ?>><?php echo esc_html( $text ); ?></p>
	<?php } ?>
	<?php if ( $show_button == 'yes' ) { ?>
        <a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
            <span class="iwt-button" <?php echo holmes_mkdf_inline_style( $arrow_styles ); ?>>
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 29.2 13.1" style="enable-background:new 0 0 29.2 13.1;" xml:space="preserve">
                    <path class=" mkdf-iwt-svg" d="M3,5.1h19.9l-1.4-1.4c-0.6-0.6-0.6-1.5,0-2.1C22.1,1,23,1,23.6,1.6l4,4c0.6,0.6,0.6,1.5,0,2.1l-4,4
c-0.3,0.3-0.7,0.4-1.1,0.4s-0.8-0.1-1.1-0.4c-0.6-0.6-0.6-1.5,0-2.1l1.4-1.4H3c-0.8,0-1.5-0.7-1.5-1.5C1.5,5.8,2.2,5.1,3,5.1z"/>
                </svg>
            </span>
        </a>
	<?php } ?>
</div>
</div>
<div class="mkdf-process-item <?php echo esc_attr( $holder_classes ); ?>">
    <div class="mkdf-process-image-holder">
        <div class="mkdf-process-image-inner">
			<?php echo wp_get_attachment_image( $image, 'full', "", [ "class" => "mkdf-idle" ] ); ?>
        </div>
        <div class="mkdf-pi-content">
            <div class="mkdf-pi-number">
				<?php echo esc_html( $number ); ?>
            </div>
			<?php if ( ! empty( $title ) ) : ?>
				<?php echo '<' . esc_attr( $title_tag ); ?> class="mkdf-pi-title" <?php echo holmes_mkdf_get_inline_style( $title_styles ); ?>>
				<?php echo esc_html( $title ); ?>
				<?php echo '</' . esc_attr( $title_tag ); ?>>
			<?php endif; ?>
			<?php if ( ! empty( $text ) ) : ?>
                <p class="mkdf-pi-text" <?php echo holmes_mkdf_get_inline_style( $text_styles ); ?>><?php echo esc_html( $text ); ?></p>
			<?php endif; ?>
        </div>
    </div>
</div>
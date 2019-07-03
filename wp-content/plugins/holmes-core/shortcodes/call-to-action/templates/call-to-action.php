<div class="mkdf-cta <?php echo esc_attr( $holder_classes ); ?>">
    <a href="<?php echo esc_attr( $button_link ) ?>" target="<?php echo esc_attr( $target ); ?>">
        <div class="mkdf-cta__text-holder" <?php echo holmes_mkdf_inline_style( $text_styles ); ?>>
            <div class="mkdf-cta__text"><?php echo do_shortcode( $content ); ?></div>
            <span class="mkdf-cta__arrow">
                <?php include HOLMES_CORE_ASSETS_PATH . '/svgs/arrow-right.php' ?>
            </span>
        </div>
    </a>
</div>
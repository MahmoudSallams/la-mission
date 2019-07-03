<div class="mkdf-price-table mkdf-item-space <?php echo esc_attr($holder_classes); ?>">
	<div class="mkdf-pt-inner" <?php echo holmes_mkdf_get_inline_style($holder_styles); ?>>
        <div class="mkdf-pt-immage">
            <?php echo wp_get_attachment_image($image, 'full'); ?>
        </div>
        <div class="mkdf-pt-inner-left">
            <div class="mkdf-pt-prices">
                <h1 class="mkdf-pt-price" <?php echo holmes_mkdf_get_inline_style($price_styles); ?>><?php echo esc_html($price); ?></h1>
                <sup class="mkdf-pt-value" <?php echo holmes_mkdf_get_inline_style($currency_styles); ?>><?php echo esc_html($currency); ?></sup>
                <h6 class="mkdf-pt-mark" <?php echo holmes_mkdf_get_inline_style($price_period_styles); ?>><?php echo esc_html($price_period); ?></h6>
            </div>
        </div>
        <div class="mkdf-pt-inner-right">
            <ul>
                <li class="mkdf-pt-title-holder">
                    <h2 class="mkdf-pt-title" <?php echo holmes_mkdf_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></h2>
                    <h6 class="mkdf-pt-subtitle" <?php echo holmes_mkdf_get_inline_style($title_styles); ?>><?php echo esc_html($subtitle); ?></h6>
                </li>
                <li class="mkdf-pt-content">
                    <?php echo do_shortcode($content); ?>
                </li>
                <?php
                if(!empty($button_text)) { ?>
                    <li class="mkdf-pt-button">
                        <?php echo holmes_mkdf_get_button_html(array(
                            'link' => $link,
                            'text' => $button_text,
                            'type' => $button_type,
                            'size' => 'large'
                        )); ?>
                    </li>
                <?php } ?>
            </ul>
        </div>
	</div>
</div>
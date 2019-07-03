<a itemprop="url" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" <?php holmes_mkdf_inline_style($button_styles); ?> <?php holmes_mkdf_class_attribute($button_classes); ?> <?php echo holmes_mkdf_get_inline_attrs($button_data); ?> <?php echo holmes_mkdf_get_inline_attrs($button_custom_attrs); ?>>
    <span class="mkdf-btn-text"><?php echo esc_html($text); ?></span>
    <?php if($description): ?>
        <span class="mkdf-btn-description"><?php echo esc_html($description); ?></span>
    <?php endif; ?>
	<?php if($enable_icon === 'yes') { ?>
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
             viewBox="0 0 29.2 13.1" style="enable-background:new 0 0 29.2 13.1; width: 23px;" xml:space="preserve">
            <style type="text/css">
                .mkdf-st0 {
                    fill: currentColor;
                }
            </style>
            <path class="mkdf-st0" d="M3,5.1h19.9l-1.4-1.4c-0.6-0.6-0.6-1.5,0-2.1C22.1,1,23,1,23.6,1.6l4,4c0.6,0.6,0.6,1.5,0,2.1l-4,4
                c-0.3,0.3-0.7,0.4-1.1,0.4s-0.8-0.1-1.1-0.4c-0.6-0.6-0.6-1.5,0-2.1l1.4-1.4H3c-0.8,0-1.5-0.7-1.5-1.5C1.5,5.8,2.2,5.1,3,5.1z"/>
            </svg>
	<?php } ?>
</a>